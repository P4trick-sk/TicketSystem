<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container w-full sm:max-w-md">
        <div class="heading">Registrácia</div>
        <form class="form" method="POST" action="{{ route('register') }}">
            @csrf

            <input
                placeholder="Meno"
                id="name"
                name="name"
                type="name"
                class="input"
                required=""
                required autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <input
                placeholder="E-mail"
                id="email"
                name="email"
                type="email"
                class="input"
                required=""
                required autocomplete="email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <input
                placeholder="Zadajte heslo"
                id="password"
                name="password"
                type="password"
                class="input"
                required=""
                required autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <input
                placeholder="Potvrdiť heslo"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="input"
                required=""
                required autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            <input value="Registrovať sa" type="submit" class="login-button" />
        </form>
        @if (Route::has('auth-google'))
        <div class="social-account-container">
            <span class="title">Alebo sa prihláste cez</span>
            <div class="social-accounts">
                <a href="{{ route('auth-google') }}" class="google-log">
                    <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                        <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                        <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                        <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                        <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                    </svg>
                    Continue with Google
                </a>
            </div>
        </div>
        @endif
        <span class="registration"><a href="{{ route('login') }}">Máte už účet ? Prihlásiť sa</a></span>
    </div>
</x-guest-layout>