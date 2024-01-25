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

    <table class="tickets">
    <thead>
    <tr>
        <th>Názov</th>
        <th>Popis</th>
        <th>Vytvoril</th>
        <th>Dátum vytvorenia</th>
        <th>Počet ticketov</th>
    </tr>
    </thead>
    <tbody>
    @if($groups->first())
            @foreach($groups as $group)
    <tr>
        <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a></td>
        <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->description }}</a></td>
        <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->createdBy->name }}</a></td>
        <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->created_on }}</a></td>
        <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->tickets->count() }}</a></td>
    </tr>
    @endforeach
    @else
    <p class="title">Žiadna skupina!</p>
    @endif
    </tbody>
</table>

</x-app-layout>
