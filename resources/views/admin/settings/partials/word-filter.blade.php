<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Filter nevhodných slov') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Zapnutím filteru sa nevhodné slová v ticketoch vymažú.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.settings.update.word-filter') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="is_filter_enabled" :value="__('Zapnúť?')" />
            <div class="mt-2">
                <select id="is_filter_enabled" name="is_filter_enabled" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option {{ $settings->is_filter_enabled == true ? 'selected' : null }} value="1">Áno</option>
                    <option {{ $settings->is_filter_enabled == false ? 'selected' : null }} value="0">Nie</option>
                </select>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('is_filter_enabled')" />
        </div>

        <div>
            <x-input-label for="filter_list" :value="__('Zoznam slov')" />
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Slová oddelte čiarkov.") }}
            </p>
            <x-text-input id="filter_list" name="filter_list" type="text" class="mt-1 block w-full" :value="old('filter_list')" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('filter_list')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Uložiť') }}</x-primary-button>
        </div>
    </form>
</section>
