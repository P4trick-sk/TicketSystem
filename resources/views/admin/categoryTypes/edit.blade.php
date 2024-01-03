<x-layouts.admin>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Typy kategórií') }}
            </h2>
            <form method="POST" action="{{ route('admin.category.types.delete', $type->id) }}" class="ml-auto">
                @csrf
                @method('delete')

                <x-primary-button class="font-semibold text-gray-900 dark:text-gray-100">
                    Zmazať typ
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.category.types.update', $type->id) }}">
            @csrf
            @method('patch')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$type->name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="sm:grid sm:grid-cols-3">
                <div class="mt-4">
                    <x-input-label for="assigned_to" :value="__('Predvolený správca')" />
                    <div class="mt-2">
                        <select id="assigned_to" name="assigned_to" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option disabled="disabled">Vyberte</option>
                            @foreach($teachers as $teacher)
                                <option {{$teacher->id == $type->assignedTo->id ? 'selected' : null}} value="{{$teacher->id}}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="is_dynamic" title="Možnosť nastaviť pre každú učebňu iného riešiteľa kategórie" :value="__('Naviazať na učebne?')" />
                    <div class="mt-2">
                        <select id="is_dynamic" name="is_dynamic" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option disabled="disabled">Vyberte</option>
                            <option {{ $type->is_dynamic ? 'selected' : null }} value="1">Áno</option>
                            <option {{ !$type->is_dynamic ? 'selected' : null }} value="0">Nie</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('is_dynamic')" class="mt-2" />
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
