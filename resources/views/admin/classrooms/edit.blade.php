<x-layouts.admin>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Triedy') }}
            </h2>
            <form method="POST" action="{{ route('admin.classrooms.delete', $classroom->id) }}" class="ml-auto">
                @csrf
                @method('delete')

                <x-primary-button class="font-semibold text-gray-900 dark:text-gray-100">
                    Zmazať triedu
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.classrooms.update', $classroom->id) }}">
            @csrf
            @method('patch')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$classroom->name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Uložiť') }}
                </x-primary-button>
            </div>
        </form>
        <form method="POST" action="{{ route('admin.classrooms.update.managers', $classroom->id) }}">
            @csrf
            @method('patch')
            <div class="pt-8">
                <div class="max-w-7xl flex">
                    <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Zoznam Priradených Učiteľov:</h3>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3">
                @foreach($managableTypes as $type)
                    <div class="mt-4">
                        <x-input-label for="type-{{ $type->id }}" :value="$type->name" />
                        <div class="mt-2">
                            <select id="type-{{ $type->id }}" name="type-{{ $type->id }}" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option {{ $classroom->managers->where('category_type_id', $type->id)->first() == null ? 'selected' : null }} value="0">Predvolený ({{ $type->assignedTo->name }})</option>
                                @foreach($teachers as $teacher)
                                    <option {{ $classroom->managers->where('category_type_id', $type->id)->first()?->assignedTo->id == $teacher->id ? 'selected' : null }} value="{{$teacher->id}}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Uložiť') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</x-layouts.admin>
