<x-app-layout>
    <x-slot name="header">
       <div class="flex">
           <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
               {{ $ticket->subject }}
           </h2>
           @can('update', $ticket)
           <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
              href="{{ route('tickets.edit', $ticket->id) }}">
               Upraviť ticket
           </a>
           @endcan
       </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                      :value="$ticket->created_on"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Kategória')" />
                    <div class="mt-2">
                        <x-text-input class="block mt-1 w-full"
                                      type="text"
                                      :value="$ticket->category->name"
                                      disabled />
                    </div>
                </div>
                <div class="">
                    <x-input-label  :value="__('Trieda')" />
                    <div class="mt-2">
                        @if($ticket->classroom)
                            <x-text-input class="block mt-1 w-full"
                                          type="text"
                                          :value="$ticket->classroom->name"
                                          disabled />
                        @else
                            <x-text-input class="block mt-1 w-full"
                                          type="text"
                                          value="Žiadna trieda"
                                          disabled />
                        @endif
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


    <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">
                {{ $ticket->description }}
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
            <div class="flex">
                <div class="text-gray-900 dark:text-gray-100">
                    <b>{{ $ticket->createdBy->name }}</b> - <i>{{ $ticket->created_on }}</i>
                </div>
            </div>
        </div>
    </div>

    @foreach ($ticket->responses as $response)
        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ $response->response }}
                </div>
                @if($response->attachments)
                    <div class="sm:grid sm:grid-cols-3 gap-4">
                        @foreach(json_decode($response->attachments) as $file)
                            <div>
                                <img src="/{{ $file }}" alt="test" style="max-height: 200px;object-fit: contain;overflow: hidden;">
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="flex">
                    <div class="text-gray-900 dark:text-gray-100">
                        <b>{{ $response->responseBy->name }}</b> - <i>{{ $response->send_on }}</i> @if(isset($response->updated_on)) <i>({{ $response->updated_on }})</i>@endif
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

    <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
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
</x-app-layout>
