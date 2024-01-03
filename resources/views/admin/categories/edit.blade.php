<x-layouts.admin>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kategórie') }}
            </h2>
            <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}" class="ml-auto">
                @csrf
                @method('delete')

                <x-primary-button class="font-semibold text-gray-900 dark:text-gray-100">
                    Zmazať kategóriu
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('patch')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$category->name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="category_type" :value="__('Typ kategórie')" />
                <div class="mt-2">
                    <select id="category_type" name="category_type" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option disabled="disabled">Vyberte</option>
                        @foreach($categoryTypes as $type)
                            <option {{$type->id == $category->categoryType->id ? 'selected' : null}} value="{{$type->id}}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_type')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Uložiť') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layouts.admin>
