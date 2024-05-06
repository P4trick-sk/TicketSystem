<x-app-layout>
    @can('update', $ticket)
    <div class="filter">
        <a href="{{ route('tickets.edit', $ticket->id) }}">
            <img
                id="filter_icons"
                src="{{ asset('icons/filter/pencil.svg') }}"
                alt="pencil"
            />
        </a>
    </div>
    @endcan
    <div class="mx-auto">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="sm:grid sm:grid-cols-3 gap-4">
                <div class="">
                    <x-input-label  :value="__('Vytvoril')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      value="{{ $ticket->createdBy->name }} ({{ $ticket->createdBy->id }})"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Pridelené')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      value="{{ $ticket->assignedTo->name }} ({{ $ticket->assignedTo->id }})"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Vytvorené')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      :value="date('d.m.Y, H:i', strtotime($ticket->created_on))"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Kategória')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      :value="$ticket->category?->name"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Učebňa')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      :value="$ticket->classroom?->name"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Priorita')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      :value="$ticket->priority"
                                      disabled />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-6 mx-auto">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">
                {{ $ticket->description }}
            </div>
            @if($ticket->attachments)
                <div class="gallery sm:grid sm:grid-cols-3 gap-4">
                    @foreach(json_decode($ticket->attachments) as $file)
                        <a href="/{{ $file }}" style="display: block">
                            <img data-pswp-width="400"
                                 data-pswp-height="500" src="/{{ $file }}" alt="test" style="max-height: 200px;object-fit: contain;overflow: hidden;">
                        </a>
                    @endforeach
                </div>
            @endif
            <div class="flex">
                <div class="text-gray-900 dark:text-gray-100">
                    <b>{{ $ticket->createdBy->name }}</b> - <i>{{ date('d.m.Y, H:i', strtotime($ticket->created_on)) }}</i>
                </div>
            </div>
        </div>
    </div>

    @foreach ($ticket->responses as $response)
        <div class="mt-6 mx-auto">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ $response->response }}
                </div>
                @if($response->attachments)
                    <div class="gallery sm:grid sm:grid-cols-3 gap-4">
                        @foreach(json_decode($response->attachments) as $file)
                            <a href="#" style="display: block">
                                <img src="/{{ $file }}" alt="test" style="max-height: 200px;object-fit: contain;overflow: hidden;">
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="flex">
                    <div class="text-gray-900 dark:text-gray-100">
                        <b>{{ $response->responseBy->name }}</b> - <i>{{ date('d.m.Y, H:i', strtotime($response->send_on )) }}</i> @if(isset($response->updated_on)) <i>({{ date('d.m.Y, H:i', strtotime($response->updated_on )) }})</i>@endif
                    </div>
                    @can('update', $response)
                    <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
                       href="{{ route('response.edit', $response->id) }}">
                        Upraviť odpoveď
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    @endforeach

    @can('update', $ticket)
    <div class="mt-6 mx-auto">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form method="POST" enctype="multipart/form-data" action="{{ route('tickets.response.store', $ticket->id) }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="response" :value="__('Response')" />
                    <x-text-input id="response" class="block mt-1 w-full" type="text" name="response" :value="old('response')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('response')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <input class="text-gray-400" type="file" name="attachments[]" id="attachment" multiple>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Odpoveď') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    @endcan
    @if($ticket->status == 'closed')
        @can('delete', $ticket)
            <div class="mt-6 mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form method="POST" action="{{ route('tickets.update.summary', $ticket->id) }}">
                        @method('patch')
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="summary" :value="__('Krátky popis vyriešenia ticketu')" />
                            <x-text-input id="summary" class="block mt-1 w-full" type="text" name="summary" :value="old('summary', $ticket->summary)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Uložiť') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
    @endif
</x-app-layout>
