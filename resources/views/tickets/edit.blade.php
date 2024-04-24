<x-app-layout>
    <div class="filter">
        <a class="font-semibold ml-auto"
           href="{{ route('tickets.show', $ticket->id) }}">
            Naspäť
        </a>
    </div>

    <div class="">
        <div class="mt-6 mx-auto sm:px-6 lg:px-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            @can('updateBasic', $ticket)
            <div class="mx-auto flex">
                <h3 class="text-xl  leading-tight">Úprava údajov:</h3>
            </div>
            <form class="pt-8 mb-4" method="POST" enctype="multipart/form-data" action="{{ route('tickets.update', $ticket->id) }}">
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

                <x-primary-button class="mt-4">
                    Uložiť ticket
                </x-primary-button>
            </form>

                <livewire:image-gallery :resource="$ticket" />
            @endcan

            @can('updateAdvanced', $ticket)
                <div class="mx-auto flex pt-8">
                    <h3 class="text-xl leading-tight">Úprava kategorizácie:</h3>
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
                                    <option value="">Vyberte</option>
                                    @foreach($classrooms as $classroom)
                                        <option {{$classroom->id == $ticket->classroom?->id ? 'selected' : null}} value="{{$classroom->id}}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('classroom_id')" class="mt-2" />
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
                                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        Uložiť ticket
                    </x-primary-button>
                </form>
                <div class="mx-auto flex pt-8">
                    <h3 class="text-xl leading-tight">Preradenie ticketu:</h3>
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
                        Preradiť ticket
                    </x-primary-button>
                </form>
                <div class="mx-auto flex pt-8">
                    <h3 class="text-xl leading-tight">Uzatvorenie ticketu:</h3>
                </div>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Môžete v skratke popísať, ako ste tento problém vyriešili.
                </p>
                <form class="pt-8" method="POST" action="{{ route('tickets.delete', $ticket->id) }}">
                    @method('delete')
                    @csrf
                    <div class="sm:grid sm:grid-cols-3">
                        <div class="">
                            <x-input-label for="summary" :value="__('Krátky popis vyriešenia ticketu')" />
                            <x-text-input id="summary" class="block mt-1 w-full" type="text" name="summary" :value="old('summary')" autofocus />
                            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        Uzatvoriť ticket
                    </x-primary-button>
                </form>
                <div class="mx-auto flex pt-8">
                    <h3 class="text-xl leading-tight">Pridanie do skupiny:</h3>
                </div>
                <form class="pt-8" method="POST" action="{{ route('ticket.group.store', $ticket->id) }}">
                    @csrf
                    <div class="sm:grid sm:grid-cols-3">
                        <div class="">
                            <x-input-label for="group_id" :value="__('Skupina')" />
                            <div class="mt-2">
                                <select id="group_id" name="group_id" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option disabled="disabled" selected>Vyberte</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        Pridať do skupiny
                    </x-primary-button>
                </form>
            @endcan
        </div>
    </div>
</x-app-layout>
