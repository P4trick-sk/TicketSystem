<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Skupiny') }}
            </h2>
            <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
               href="{{ route('groups.create') }}">
                Pridať skupinu
            </a>
        </div>
    </x-slot>


    @if($groups->first())
        @foreach($groups as $group)
            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <a style="text-decoration: underline" class="font-semibold text-gray-900 dark:text-gray-100"
                           href="{{ route('groups.show', $group->id) }}">
                            {{ $group->name }}
                        </a>
                        <div class="text-gray-900 dark:text-gray-100">
                            {{ $group->description }}
                        </div>
                        <dl class="divide-y divide-gray-100">
                            <div class="sm:grid sm:grid-cols-2">
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Vytvoril</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $group->createdBy->name }}</dd>
                                </div>
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Počet tickov</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $group->tickets->count() }}</dd>
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
                        Žiadna skupina!
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
