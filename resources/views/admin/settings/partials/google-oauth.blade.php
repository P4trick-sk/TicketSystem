<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Google OAuth2') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Údaje od google api, pre prihlasovanie pomocou vašej domény.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.settings.update.google-oauth') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="google_client_id" :value="__('Google client id')" />
            <x-text-input id="google_client_id" name="google_client_id" type="text" class="mt-1 block w-full" :value="old('google_client_id', $settings->google_client_id)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('google_client_id')" />
        </div>

        <div>
            <x-input-label for="google_client_secret" :value="__('Google client secret')" />
            <x-text-input id="google_client_secret" name="google_client_secret" type="text" class="mt-1 block w-full" :value="old('google_client_secret', $settings->google_client_secret)" required autofocus autocomplete="school_name" />
            <x-input-error class="mt-2" :messages="$errors->get('google_client_secret')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Uložiť') }}</x-primary-button>
        </div>
    </form>
</section>
