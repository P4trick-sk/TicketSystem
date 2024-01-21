<x-app-layout>
 {{--   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
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
            <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Moje Tickety:</h3>
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
    @endif--}}

    <ul class="message-list">
        @if($tickets->first())
            @foreach($tickets as $ticket)
            <li class="unread">
                <a href="{{ route('tickets.show', $ticket->id) }}">
                    <div class="col col-1"><span class="dot"></span>
                        {{--<div class="checkbox-wrapper">
                            <input type="checkbox" id="chk1">
                            <label for="chk1" class="toggle"></label>
                        </div>--}}
                        <p class="title">{{ $ticket->subject }} ({{ $ticket->id }})</p><span class="star-toggle glyphicon glyphicon-star-empty"></span>
                    </div>
                    <div class="col col-2">
                        <div class="subject">{{ $ticket->assignedTo->name }} - {{ $ticket->description }}</div>
                        <div class="date">{{ $ticket->send_on }}</div>
                    </div>
                </a>
            </li>
            @endforeach
        @else
            <li class="unread">
                <div class="col"><span class="dot"></span>
                    <p class="title">Žiaden ticket</p>
                </div>
            </li>
        @endif
    </ul>


</x-app-layout>
