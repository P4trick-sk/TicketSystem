<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $group->name }}
            </h2>
            @can('update', $group)
            <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
               href="{{ route('groups.edit', $group->id) }}">
                Upraviť skupinu
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$group->name" required autofocus disabled autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$group->description" required autofocus disabled autocomplete="name" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </div>

    @can('update', $group)
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex pt-8">
            <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Odošlite správu do každého ticketu:</h3>
        </div>
        <form class="pt-8" method="POST" enctype="multipart/form-data" action="{{ route('groups.send.response', $group->id) }}">
            @csrf

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
                <x-primary-button class="mt-4">
                    Odoslať
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex pt-8">
            <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Uzatvorenie ticketov v skupine:</h3>
        </div>
        <form class="pt-8" method="POST" action="{{ route('groups.close.tickets', $group->id) }}">
            @method('delete')
            @csrf

            <div class="">
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
    </div>
    @endcan

    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Tickety v skupine:</h3>
        </div>
    </div>

    @if($group->tickets->first())
        @foreach($group->tickets as $ticket)
            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <a style="text-decoration: underline" class="font-semibold text-gray-900 dark:text-gray-100"
                           href="{{ route('tickets.show', $ticket->id) }}">
                            {{ $ticket->subject }}
                        </a>
                        <div class="text-gray-900 dark:text-gray-100">
                            {{ $ticket->description }}
                        </div><dl class="divide-y divide-gray-100">
                            <div class="sm:grid sm:grid-cols-3">
                                @if(isset($ticket->assignedTo))
                                    <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                        <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Pridelený správca</dt>
                                        <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->assignedTo->name }}</dd>
                                    </div>
                                @endif
                                @if(isset($ticket->classroom))
                                    <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                        <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Trieda</dt>
                                        <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->classroom->name }}</dd>
                                    </div>
                                @endif
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Status</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->status }}</dd>
                                </div>
                            </div>
                        </dl>
                        @can('update', $group)
                        <form class="pt-8" method="POST" action="{{ route('groups.remove.ticket', [$group->id, $ticket->id]) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="font-semibold text-gray-900 dark:text-gray-100">Odstrániť zo skupiny</button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="pt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Žiaden ticket!
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
