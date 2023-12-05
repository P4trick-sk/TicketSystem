<x-app-layout>
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('tickets.store') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="subject" value="Predmet" />
                    <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required autofocus />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <div class="sm:grid sm:grid-cols-3">
                    <div class="mt-4">
                        <x-input-label for="classroom" :value="__('Trieda')" />
                        <div class="mt-2">
                            <select id="classroom" name="classroom" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected="true" disabled="disabled">Vyberte</option>
                                @foreach($classrooms as $classroom)
                                    <option value="{{$classroom->id}}" >{{ $classroom->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Kategória')" />
                        <div class="mt-2">
                            <select id="category" name="category" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected="true" disabled="disabled">Vyberte</option>
                                @foreach($categoryTypes as $type)
                                    <optgroup label="{{ $type->name }}">
                                        @foreach($type->categories as $category)
                                            <option value="{{$category->id}}" >{{ $category->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="description" value="Popis problému" />

                    <x-text-input id="description" class="block mt-1 w-full"
                                  type="text"
                                  name="description"
                                  :value="old('description')"
                                  required />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4">
                    Pridať ticket
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
