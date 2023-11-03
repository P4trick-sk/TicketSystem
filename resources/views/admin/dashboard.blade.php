<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Ahoj <b>{{ Auth::user()->name }}</b>! Tvoja rola je: <b>{{ Auth::user()->role }}</b>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Všetky Tickety:</h3>
            <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
               href="{{ route('tickets.create') }}">
                Pridať ticket
            </a>
        </div>
    </div>
    @if($tickets->first())
        @foreach($tickets as $ticket)
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
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Vytvoril</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->createdBy->name }}</dd>
                                </div>
                                @if(isset($ticket->assignedTo))
                                    <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                        <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Pridelený správca</dt>
                                        <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->assignedTo->name }}</dd>
                                    </div>
                                @endif
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Status</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->status }}</dd>
                                </div>
                            </div>
                        </dl>
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
