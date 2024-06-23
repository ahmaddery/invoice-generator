<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <a class="btn btn-link" href="{{ route('auth.google') }}">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWwAAACKCAMAAAC5K4CgAAABoVBMVEX///9Bg/NChPT///n//f/+//v5+fy31Oj5+PXA1e1ChPg5fek3ffD///1Dg/U4fO2/2exBhfDx//9sluNlkc5Th+FBf/hCd93f8/ZBh+76///8//fsQTf///X/+/8/gvmYuutEgP14o92NrtnN4fWgvuKOsOc+guT1//o9fuVAh/m01PTu9vfH2/p7p+w7hez//+1ymt/n8/nT6PVkjNW70/k5plkxp1FFetvk8v9wm9FOgdypwfBlkOa93vNhmOFOid2hvfr76vDz2ND3ubHrnJbcjInzrKD3yr/+6ePtpqTbam3SPzLpOyzVWVfgh4XMSUL77N/zPzHUVlPUcGPoODjvPyjRQjbbOyzUSzzsuK3tqGrYTBfpP0Dsxbpxl/P+7b/ztjD7nS5Gd8f11IrzuQD7qiHqbSjqw1zhgzP/+tnmuTqnwNuKsvWCqvSjuOVnhtZSgcjg5Oj4whDStU/n6suMpMyyuDdfmzOkyp7845/kwSiTtDlKoUZSpmfL7NbJwVxss39QqWWmzrGIwJlLlo08jsc5oHk9mKJ7sLo7llCNjpFzAAARYElEQVR4nO2di3/bxn3AcQCPkvDUgSZIHE2BpEC8+BJBSSYDUqKTLM3DblKva5Ts4WSu0yyxVKfZunVr47lxuy1/9X4H6OWIth6hEtm+78eS+AAB4nuHH+7ud4AFgcPhcDgcDofD4XA4HA6Hw+FwOBwOh8PhcDgcDofD4XA4HA6Hw+FwOJyXk5ygYQ3AnKcR2E9OwNr8XGs0yOcYqXhOBpNBQYcmaHN0LWgVSapKnJOsVaUqljQ6R9lQiCN3gTODpaVBPMeajbGGR7VpaFkq5wSWar/WoZU5BW0NS9jth5EtAjqAzoT4akDgJ0zGVMJzqd14RRtMiOOw9epn56e28CMBUghSh2OTStI8bOfaDUN2ZNFxzuFaJ0R8FYQz2bqjJy7VFufgeqW6ZdgI1or86XbhzBRthVXvlz2cMNlQq3q/b+fz86jZtIZkQClsxFkLRzsNFr9GW40QEajh7CudLcy/qMAO6sWRlKuwff+hshsI6brSjzVJyp3pE5qWy1WqsVciliO+ErLF0NVW8Bxk56/pPSROXTgD0HR1p3atmOyVxWpcII6FXg3ZxpKW03647Bxdl30RdStgEWNWesfjiHD47OgRhBEhJ1UC4aYvW69IzVaXqjlpDjXbvOboUHL0SPBZYIsNFGLZ5KWXzTCWJQH/QNEHsomygM8rmwrlxLYIl31e2eIFZGsgu1fnNfsisisXqNlDkcs+FznzmoWIsvzUqtLTYAVLmFIBSwKlcOakJ8YZyyXbeQXa2Yw5y366QjPbaStvJZdbzGetvRONcJAtc9lzkk1pzqRQrRkBFbjsy5GdNacD4fU33vybt95662dvv7OonRzS5bLnIptVaorfefe9Wzu3gZ1bP3//7UWaW8kFx8+gJ2Q/Jf7gycGYzokd0J/1Bnpm+f1kJXuZsildERbf/fmt64fsfPDWO1ACeI6yxWe98+xe6cspewX/4v2d63duH7i+c+fOzt++nQ2ecNnzlb2i/eKXt29fPwY8++hNQeA1e76ypVwO03fe+7vrd25dv/OrnVsffPDhzp07t29/+KZEc6fXbFmHf/AY/iKdIMcSD3No6CibBg9kJBICr6Qpn6PdShMSOstGwVpE4hA22u7Aaz1dZm8QWBZWyZZDIjLgBxY9KFX2RyeEHK2OsBdYvk9G7GXx2FtXQTbOCTT31s712zsQqX/5szdef+eNj9//aOejN090MZ+SfWCRDZZEEewescFUj5mblT8jIvSHiMxSnyiTf1gK6W8wAwupyIkQlIqjR45ed0gqG9bHkqB6JDtQDvr+ssdWTY5tkmQ/UPYRLKWLF2w9XZZsiqnw5odpoP7g3dc1agbQBHn7vY8rwqmy2V76ohVO7yWKDBKRBRUy3fMsSZyOWh1SN0RHtJnwE7IzZaKjOkSXDbVny35houi2nq0L3DlR3fGTJAkta9+geJCGhj/ysUJNDxVS3J7Cl5HZkSefcQLBjyFbkOja3//D9X+8feeDf9JyGs5GqF5fFHKny2b7aSS1QdmtFRTH9/bCur6fGdb3BWbiWW7vrldQ7DSSfF92VjeJ0l+1I500GrZtrZcHUycSs2oNh4ROku7GoDzY6Pvk2BZmHEHp7/BmeUOBoykrhasjOyflP/n0n3+z86tbH2PKXqUUBzkTOpRZDuFomzNlO1MXB7SqxQ3D0+JtGVQgkiZOe6AoXQqldVFxKxsGxGG2gJ5KgIABRzoLrqJsQYCx40pNkf22VEDyNWre0yO2cPrxCE1ckw2GaWarqIiWngUwJ6vlJC3VCOIPxGwdvgJRxpUtxdYth9g2uUDcvjTZFfzr+/c/+83t9xc1aFnn9sefDqcb4sNu+8wTpNLS2s3VZlxpKd14MIX9BA9svIrYosUyO+lHWO3smLUQRQ5LG4shq8vEYmHVYcEegrQo2ltmF8nDdqVfl9epOfTlNBaxDfaKrkY7tdWmSystmVhgWocSYFMs2BlajrLYDq+yqE50dax1QnZ6OJyBcTVka3jt86/B9r+8zcZRQXYFY1ypSFIFCCpa7nCjJ2SzAOEPpKZRV/rjCfELUzkikaIYRoQUxLzLoWI4NhssRMjf9h3UA/lK2LNZbYZ3ZWT3iIJk2yeKoRev6cQZlrWCikC2FYZhvc5mAjhWsoHbXqiq6F7T9BSI/Y4e+lBOCEUybEtRLZ21PCJkKKEd9WSDyUbE1lXFcS7Qgry0ph/+4sv7wOdr7FwJVbm56q0e8oCuVJ4rOxxUWwlxLAPpttdFTm/YHTe9pL9rOxOvv10be1OfsJitFLyJY+/uFb1xbWKwwFsv7u5BQy/cK6gygcd217OL3qop/NYrgOyHXqu27UcsFjl9U/ASqMlO5N9FMrGVYaHW8opwlMihX6g1a4Uh1G+U9Juw7YZnp7LtUC00W7CxqyO7IoDsz+5//flaLpM9NSwjC3NQYybt59Rs9lhtVdut9RBauE4Bx4nquyYWAjcOdo2mFo80CbvgGIK0MtBqSl8wB5JUHTVUCPjhahD0df2aOUiQ4uHy+oB6XYEG0BatPaQVF0tS2TNYSPablRiKTEZhqKi9UFemW6akVcpNX9eLrRhjqT1ORDRtBZpEB4HWTcOIOlkOBK0Se+qVkU3xJ5+ymv3rCtVy7JqESc9x2ImJTQa0JiPhcB7W7JhdGGmYLndDFU20tjJcFqTBkhtIea/eFCrthWVTG4QEikJxqzWjSxfp8kIstbdZNE9cCEFWkwbXnKFbHScD7G0vtxaxu9x9SKt0aWFUbRdY3FW2hGWlJ4aF7t5ed69BfLfadpdGVFglxgKlo6UB1pqK39IEd2EkUKFRH0sdJXGrZqc1wnRdTlvm52gCXlrMFj758v7XLIxQvC9bR5GRzQyyJrHw7B4knPZJHa23TFwNIJZMBNPomkGtpCZNjTLZ5b5R8rT2BOJIJrsvwNtWYYSbBvgPm3SQFAfVtZaxbdK+P9A83yrFUiEM1wOtphoP40rTgLaINcBLJSIWzKomYFqeeBrd9Y1ppxI/7NOg6RvDDWyu93NSU1GGrX3ZsOW4XzISl0IrUL4qsr/Yl51nE0QErYgcCI4Om/2kOwV61CCfKRsqbSmpjbRgHN7V2kYTj4YRcgoxbtR/Kwx8J5rGUlc5lE1NOIkmS8IDQ7cdYz3O9/t0JMX3mhU3tEG2YSum1hfFh7T9FbL9jrChQCvbWhCWQxJNO67rxiujr7aoO5SJUcjT/oYwGkJX6F4br3rV9hCWHcZMNu6UWvh3D4ABfCXWSDxPKLk02bkvvvzs/v2v//XfKJaY7NVVj50hu77Izkz06JqHmWHEshQxUqZLkuvflUxjQXBD6EQmg2AXZIMhZI8qDfW4bKT7S/gBnBMhai9Vm0va2KW/H1EPJYOKh2wjoH04XALzXkRKG3gJZDsKHCTFnkz8YThsCoOhKzwIke8kI6nb0bZKjh9B/X1Qk0alOiElJruJO8MtqDySANLKfmTp57J9ae3soPL5/fuf/vt//EFbCXCa6aXUpNoW9MAsVJOe1xqB/rnSTaxepKxqo2Kh2i7VqvG6KluvmdRTm9KyYcvFGM5X8DnFlWpqH8dF6CpuCU0LyioyGmacNyc14XfBaIpCJpuoJi0gsk6DoS0qG3hDYa3p4kjaKEWkLlvrMR6XlgS3ZFlWv722vaGNhvXIutcOVhuSua1EYSHPZEudcAO7nuftdnf3QnLOtvYldmr+8/5//fFPm988ElaYbPaihoNdC/p1YQvnn9Ma6elKzVyahkbS0lxlUm0r2zHuFJKGK9EGk60SpzjSurpsH8lGmWzW5ZCnIyy5w6/MRfogtNKaLapt4UC2vi9bREqNBhvrijEsuNJo4nuVys1SqdgRRj4cK7VhmLQq5W0IWG4/6bvCfhjxhLZXMoZeA4rJvyqyhS/++483bmxuPn7ELozMsuy05VsQ6NZjLf+cIVaQ3QrW4s7GiNKmysLIsFbBdNSmEu1msq1iWYN+4VHNTvQj2XCKxIFHSh3JfM3JZJMj2eRQth5Br0ZqD9xBWwo8CCdb0uLALWPsIb8l4VFnoEljP6xRqT2KK1om2yhuVfPuxiAwJ0iuXw3ZQjWn/eFPNxiPH7GRPjZhhC4klq2IoUdz9NnddYjEKKnFkiBJ7Y0i2obWCFT1ATXj5ojuZmHEyWRDzR5INdTXTJBdGggtlbUuLTSNzaleb1DXj0TojIJsIxD6+7JR2NJANrQkelbixZqGBTzY83XLn7TYtMf2zR5xphsUa1IM7Wwy9AY0aDfzqWzXIOtbQRWWGttO1mm/ArLh0dpjqNlg+8/fPgrAdPDoyV/+SsSemAyOJ3ROyhbZET7ZrdW87SEixe5eqCd+sdufXCubff1ut8BGO7vdIhv3R9vdieyzRUSy3b2bDdwhUiiEouN3C+x5Ya8IC3Yb7MqIbjcUdTKBVbCsApH1cNq9Ofa6RYMlKZRif7fmwUfh+Bj2b7KH0BctTqf97vrDmDYQ+yAbKbx5c7cQslGTs4u+VNmMR9+kVfvG5p8fP3ny+PHmjc2//HUalcZPzYqa2RohJAx9X9HT8TxFLG51+qGSbEjlqSiT1GioZC1ckkbfNMtOyLFsDvuHSDY+mJnNkjBsbBYp5GBDsqwaioIOBmVD6Exm49hQDmHIhlqmS+46UpMWjqeyoqSZh9BX2ODIubnUqQwHtjdvHPI//zvcDZ5aanYOMhvsjPR0PFUtmGuxuwydylooy2J2oQIbRmUaj4b4Zefgkc4G96Gkjt7Ts+XY6N3hlYOpX5HlaVA2Rs56t9HByrLEg4y287DtzqhCm0o9HbfVs5Fy+WrJFlaEb1Pbm5ub7Fcq/Zv/g2h8quz9fMl+nkBGjTKVqkF5PGQpsEOFB0sfLnmcY5f+HXvz4NWjQ0hhOUVC9jcaEbK/NLFtKD5dVBqjoFoV2uOpbO0v+Jw5KT+ZbNZzfPT4u1T0Zir8xuY3T6BePz+MoPRYZx3NLE3AcglG0q3VdiGyqmm+8Rj7z2bkYY9CKnuwP9ifRvRjaxD1/WQb+4CehZm0MFmmOa2+REm6zZr3VSn9UiQbcJDPfF3tjyU7Ze3bx0dR5DtoBwrfm088c/rZ96upiFRVhej8nAkKF+NoA7O2moUcOF0bqvW9o+UqpcUOWdGgFfL4m+++++7xk28f0SwHeX7ZDFm+UH7kuTxfdoYDvfLsfPDUZcnn39hly9bYvTYEHACV9MYNJ2bKg+yT10Ge2OEslJLslDcfz09vaOZW0y1DPLOBqyNbmDUZPrONKc3G/TA8mnFVwsFk+Kdi4IxaLTuIJQPn6/rpmVbPkH3058rIZhcwzZB9KuUhqZ+QfULIRWVeKeYoe3bN5rKPmJdsymWfzhxlk5mtkTPIFrns8wFhxBbDhfPKhtNn+Z7V4xednlu2Hjal05c8Drtsj+X9Lnh2f9GYo2xiiN3gnLLxIh0r6WjHRebOvWjMs2bbznBwvk/lcrl2XybEenVkz+FOOitmo+6LYliMcfWMty9hd9JZrJa7L/s9i8T9SdDwGy3n5nEnnRVaqxMko3BaG8SVM93GkXXhy62CKp/+ZV98dLEnqqg4WszN4046WicRkSxHsjKcFs+E7/vFYvgq3PwsTQP1ZMdvtHMnx4bOD100G2w6uthDEUthpKO9z77FHEoHS9Msy6twc790Fx1UXMoLdA6yV3DVLSBHTPNLjrN/d79nbvzoTRD+8qPLOrEjf5w/263KTiOnLa643WGYDsqdrbj3808n0lkvIXCw+0oyjufR7GPQ3AoejRtFA1AYxmmkN4S1VFV5+QnDZOJ1VvL5+bhm9wRYXMzH7hJnBh13FGuL8wkiLIxorIuyeF7y+fy5P/Niks9r84oih+Q5s5m3aEHIOqOX858HvNBcgmoOh8PhcDgcDofD4XA4HA6Hw+FwOBwOh8PhcDgcDofD4XA4HA6Hw+FwOBzOpfL/I4TWXSf47XYAAAAASUVORK5CYII=">
                </a>    
            </div>
        </div>    
    </form>
</x-guest-layout>
