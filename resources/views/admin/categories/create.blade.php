<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategórie') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="pt-8">
                <div class="max-w-7xl flex">
                    <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Kto má problém riešiť?</h3>
                </div>
            </div>

            @foreach($categoryTypes as $type)
                <div class="flex items-center mb-4 mt-4">
                    <input id="{{ $type->id }}" type="radio" value="{{ $type->id }}" name="category_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $type->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $type->name }}</label>
                </div>
            @endforeach

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Uložiť') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layouts.admin>
