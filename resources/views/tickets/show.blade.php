<x-app-layout>
    @error()
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="space-y-3">
            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">ID:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 inline-flex items-center text-sm text-gray-800 ">
                            {{ $ticket->id }}
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Subject:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 inline-flex items-center text-sm text-gray-800 ">
                            {{ $ticket->subject }}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Vytvoril:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 inline-flex items-center text-sm text-gray-800 ">
                            {{ $ticket->createdBy->name }}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Popis:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 inline-flex items-center text-sm text-gray-800 ">
                            {{ $ticket->description }}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Kategória:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 inline-flex items-center text-sm text-gray-800 ">
                            {{ $ticket->category->name }}
                        </li>
                    </ul>
                </dd>
            </dl>
            @if($ticket->custom_data)
                @foreach($ticket->custom_data as $key => $value)
                    <dl class="flex flex-col sm:flex-row gap-1">
                        <dt class="min-w-40">
                            <span class="block text-sm text-gray-500 dark:text-neutral-500">{{ $key }}:</span>
                        </dt>
                        <dd>
                            <ul>
                                <li class="me-1 inline-flex items-center text-sm text-gray-800 ">
                                    @if(gettype($value) == "array")
                                        {{ implode(",", $value) }}
                                    @else
                                        {{ $value }}
                                    @endif
                                </li>
                            </ul>
                        </dd>
                    </dl>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
