<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $group->name }}
            </h2>
            <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
               href="{{ route('groups.edit', $group->id) }}">
                Upraviť skupinu
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$group->name" required autofocus disabled autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$group->description" required autofocus disabled autocomplete="name" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </div>
</x-app-layout>
