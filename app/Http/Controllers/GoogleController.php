<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGooglecallback(){
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $findUser = User::where('google_id', $googleUser->id)->first();

            if($findUser){
                Auth::login($findUser);
            } else {
                $user = User::updateOrCreate([
                    'email' => $googleUser->email,
                ], [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('12345678'),
                ]);

                Auth::login($user);
            }

            return redirect()->intended('home');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Failed to login using Google.');
        }
    }
}
