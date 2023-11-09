<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $ticket->subject }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">
                {{ $ticket->description }}
            </div><dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Created by</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->createdBy->name }}</dd>
                </div>
                @if(isset($ticket->assignedTo))
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Assigned to</dt>
                        <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->assignedTo->name }}</dd>
                    </div>
                @endif
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Priority</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->priority }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Created on</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->created_on }}</dd>
                </div>
                <div class="px-4 pt-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Status</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $ticket->status }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @foreach ($ticket->responses as $response)
        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ $response->response }}
                </div>
                <div class="text-gray-900 dark:text-gray-100">
                    <b>{{ $response->responseBy->name }}</b> - <i>{{ $response->send_on }}</i>
                </div>
            </div>
        </div>
    @endforeach

    <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form method="POST" action="{{ route('tickets.comment', $ticket->id) }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="response" :value="__('Response')" />
                    <x-text-input id="response" class="block mt-1 w-full" type="text" name="response" :value="old('response')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('response')" class="mt-2" />
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
