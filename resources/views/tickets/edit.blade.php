<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Úprava ticketu') }}
            </h2>
            <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
               href="{{ route('tickets.show', $ticket->id) }}">
                Naspäť
            </a>
        </div>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="max-w-7xl mx-auto flex">
                <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Úprava údajov:</h3>
            </div>
            <form class="pt-8" method="POST" enctype="multipart/form-data" action="{{ route('tickets.update', $ticket->id) }}">
                @method('patch')
                @csrf

                <div>
                    <x-input-label for="subject" value="Predmet" />
                    <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="$ticket->subject" required autofocus />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" value="Popis problému" />

                    <x-text-input id="description" class="block mt-1 w-full"
                                  type="text"
                                  name="description"
                                  :value="$ticket->description"
                                  required />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                @if($ticket->attachments)
                    <div class="sm:grid sm:grid-cols-3 gap-4">
                        @foreach(json_decode($ticket->attachments) as $file)
                            <div>
                                <img src="/{{ $file }}" alt="test" style="max-height: 200px;object-fit: contain;overflow: hidden;">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4">
                    <input class="text-gray-400" type="file" name="attachments[]" id="attachment" multiple>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4">
                    Uložiť ticket
                </x-primary-button>
            </form>

            @can('updateAdvanced', $ticket)
                <div class="max-w-7xl mx-auto flex pt-8">
                    <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Úprava kategorizácie:</h3>
                </div>
                <form class="pt-8" method="POST" action="{{ route('tickets.update.advanced', $ticket->id) }}">
                    @method('patch')
                    @csrf
                    <div class="sm:grid sm:grid-cols-3">
                        <x-category-select :categoryTypes="$categoryTypes" :selectedId="$ticket->category->id"></x-category-select>
                        <div class="">
                            <x-input-label for="classroom_id" :value="__('Trieda')" />
                            <div class="mt-2">
                                <select id="classroom_id" name="classroom_id" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option disabled="disabled">Vyberte</option>
                                    @foreach($classrooms as $classroom)
                                        <option {{$classroom->id == $ticket->classroom->id ? 'selected' : null}} value="{{$classroom->id}}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <x-input-label for="priority" :value="__('Priorita')" />
                            <div class="mt-2">
                                <select id="priority" name="priority" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option disabled="disabled">Vyberte</option>
                                    @foreach($priorities as $priority)
                                        <option {{$priority == $ticket->priority ? 'selected' : null}} value="{{$priority}}">{{ $priority }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        Uložiť ticket
                    </x-primary-button>
                </form>
                <div class="max-w-7xl mx-auto flex pt-8">
                    <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Preradenie ticketu:</h3>
                </div>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    POZOR! Týmto úkonom môžete prísť o prístup do ticketu!
                </p>
                <form class="pt-8" method="POST" action="{{ route('tickets.update.assign', $ticket->id) }}">
                    @method('patch')
                    @csrf
                    <div class="sm:grid sm:grid-cols-3">
                        <div class="">
                            <x-input-label for="assigned_to" :value="__('Učiteľ')" />
                            <div class="mt-2">
                                <select id="assigned_to" name="assigned_to" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option disabled="disabled">Vyberte</option>
                                    @foreach($teachers as $teacher)
                                        <option {{$teacher->id == $ticket->assignedTo->id ? 'selected' : null}} value="{{$teacher->id}}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        Preradiť
                    </x-primary-button>
                </form>
                <div class="max-w-7xl mx-auto flex pt-8">
                    <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Uzatvorenie ticketu:</h3>
                </div>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Môžete v skratke popísať, ako ste tento problém vyriešili.
                </p>
                <form class="pt-8" method="POST" action="{{ route('tickets.delete', $ticket->id) }}">
                    @method('delete')
                    @csrf
                    <div class="sm:grid sm:grid-cols-3">
                        <div class="">
                            <x-input-label for="summary" :value="__('Sumár')" />
                            <x-text-input id="summary" class="block mt-1 w-full" type="text" name="summary" :value="old('summary')" autofocus />
                            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        Vymazať
                    </x-primary-button>
                </form>
            @endcan
        </div>
    </div>
</x-app-layout>
