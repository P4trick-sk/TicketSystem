<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Triedy') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.classrooms.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="pt-8">
                <div class="max-w-7xl flex">
                    <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Zoznam Priradených Učiteľov:</h3>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3">
                <div class="mt-4">
                    <x-input-label for="technical_manager" :value="__('Technický správca')" />
                    <div class="mt-2">
                        <select id="technical_manager" name="technical_manager" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option selected="true" disabled="disabled">Vyberte</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <x-input-label for="room_manager" :value="__('Správca učebne správca')" />
                    <div class="mt-2">
                        <select id="room_manager" name="room_manager" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option selected="true" disabled="disabled">Vyberte</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" >{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
