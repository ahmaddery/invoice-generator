<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle() {
        if (auth()->check()) {
          return redirect()->intended('dashboard');
        }
      
        return Socialite::driver('google')
          ->redirect(route('auth.google.callback')); // Use the defined route name
      }
      
    
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $findUser = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($findUser) {
                $this->updateGoogleTokens($findUser, $googleUser);
            } else {
                $findUser = $this->createNewUser($googleUser);
            }

            Auth::login($findUser);

            return redirect()->intended('dashboard');

        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Failed to login using Google.');
        }
    }

    /**
     * Update user's Google tokens if necessary.
     *
     * @param User $user
     * @param \Laravel\Socialite\Contracts\User $googleUser
     * @return void
     */
    private function updateGoogleTokens(User $user, $googleUser)
    {
        if ($this->tokenExpired($user->google_token)) {
            $this->refreshGoogleToken($user);
        }

        if ($googleUser->token !== $user->google_token) {
            $user->update([
                'google_token' => $googleUser->token,
            ]);
        }
    }

    /**
     * Create a new user using Google authentication.
     *
     * @param \Laravel\Socialite\Contracts\User $googleUser
     * @return User
     */
    private function createNewUser($googleUser)
    {
        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'password' => Hash::make('12345678'),
        ]);
    }

    /**
     * Check if the Google token has expired.
     *
     * @param string $token
     * @return bool
     */
    private function tokenExpired($token)
    {
        // Implement token expiration check logic here
        return false; // Dummy return for now
    }

    /**
     * Refresh the Google token using the refresh token.
     *
     * @param User $user
     * @return void
     */
    private function refreshGoogleToken(User $user)
    {
        // Implement token refresh logic here
    }
}