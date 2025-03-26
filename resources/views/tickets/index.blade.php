<x-app-layout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <a href="{{ route('tickets.create') }}" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                Vytvoriť ticket
            </a>
            <div class="flex flex-col mt-4">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">#</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Subject</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Vytvoril</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Dátum</th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @if($tickets)
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-800 ">{{ $ticket->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">{{ $ticket->subject }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{{ $ticket->createdBy->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{{ $ticket->created_at }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Otvoriť</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        Žiaden ticket
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
