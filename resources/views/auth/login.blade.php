<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="165.000000pt" height="165.000000pt" viewBox="0 0 165.000000 165.000000" preserveAspectRatio="xMidYMid meet">

            <g transform="translate(0.000000,165.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
            <path d="M708 1590 c-256 -47 -463 -200 -573 -424 -101 -206 -101 -461 -1 -671 225 -471 861 -580 1231 -209 147 146 225 335 225 544 0 156 -39 289 -123 418 -104 158 -268 277 -452 326 -71 20 -241 28 -307 16z m310 -41 c161 -41 337 -168 431 -312 301 -463 13 -1077 -539 -1148 -250 -32 -524 83 -676 284 -110 145 -160 308 -151 491 13 274 157 501 397 625 171 89 347 109 538 60z"/>
            <path d="M762 1353 c-65 -129 -72 -139 -111 -156 -62 -28 -136 -91 -176 -150 -66 -97 -92 -242 -64 -349 11 -42 10 -46 -45 -155 -31 -62 -56 -117 -56 -123 0 -6 60 -10 168 -9 133 0 163 3 148 12 -72 45 -146 139 -146 186 0 29 233 517 260 545 15 16 33 19 93 19 40 0 79 -3 87 -8 15 -9 270 -530 270 -552 0 -37 -68 -126 -134 -174 l-39 -29 171 0 c95 0 172 2 172 5 0 3 -25 56 -56 118 l-57 112 12 56 c22 110 9 206 -42 304 -39 75 -73 110 -167 173 l-85 57 -60 122 c-33 67 -63 125 -67 128 -4 4 -38 -55 -76 -132z m128 -105 c0 -5 -25 -8 -55 -8 -30 0 -55 2 -55 5 0 2 12 30 27 60 l27 55 28 -52 c15 -29 27 -56 28 -60z m-254 -150 c-32 -75 -188 -388 -193 -388 -3 0 -3 37 -1 83 8 126 65 235 156 302 26 19 48 35 50 35 1 0 -4 -15 -12 -32z m478 -49 c62 -68 99 -158 103 -253 l4 -81 -37 70 c-21 39 -66 130 -100 203 -61 128 -62 132 -35 118 15 -8 45 -34 65 -57z m-593 -561 c9 -16 4 -18 -56 -18 l-65 0 26 52 26 52 29 -35 c16 -18 34 -42 40 -51z m719 36 c11 -25 20 -48 20 -50 0 -2 -27 -4 -60 -4 -33 0 -60 3 -60 6 0 7 71 94 77 94 2 0 13 -21 23 -46z"/>
            <path d="M800 760 l0 -70 -75 0 c-73 0 -75 -1 -75 -25 0 -24 2 -25 75 -25 l75 0 2 -202 3 -203 33 -3 32 -3 0 205 0 206 81 0 80 0 -3 28 c-3 27 -4 27 -80 30 l-78 3 0 64 0 65 -35 0 -35 0 0 -70z"/>
            </g>
            </svg>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
