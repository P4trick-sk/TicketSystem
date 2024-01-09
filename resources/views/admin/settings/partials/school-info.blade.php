<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Údaje školy') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Meno školy, ktoré sa zobrazí na hlavnej stránke a jej logo.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.settings.update.school-info') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="school_name" :value="__('Názov školy')" />
            <x-text-input id="school_name" name="school_name" type="text" class="mt-1 block w-full" :value="old('school_name', $settings->school_name)" required autofocus autocomplete="school_name" />
            <x-input-error class="mt-2" :messages="$errors->get('school_name')" />
        </div>

        <div>
            <x-input-label for="school_logo" :value="__('Logo')" />
            <input class="text-gray-400" type="file" name="school_logo" id="school_logo">
            <x-input-error class="mt-2" :messages="$errors->get('school_logo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Uložiť') }}</x-primary-button>
        </div>
    </form>
</section>
