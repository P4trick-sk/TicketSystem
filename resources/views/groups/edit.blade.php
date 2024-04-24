<x-app-layout>
    <div class="filter">
        <a class="font-semibold ml-auto"
           href="{{ route('groups.show', $group->id) }}">
            Naspäť
        </a>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('groups.update', $group->id) }}">
            @method('patch')
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $group->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $group->description)" autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Uložiť') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('groups.delete', $group->id) }}" class="ml-auto">
            @csrf
            @method('delete')

            <x-primary-button class="font-semibold">
                Zmazať skupinu
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
