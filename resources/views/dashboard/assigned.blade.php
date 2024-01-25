<x-app-layout>

    <table class="tickets">
    <thead>
    <tr>
        <th>Predmet</th>
        <th>Vytvoril</th>
        <th>Vytvorené</th>
        <th>Priorita</th>
        <th>Kategória</th>
        <th>Učebňa</th>
    </tr>
    </thead>
    <tbody>
    @if($tickets->first())
            @foreach($tickets as $ticket)
    <tr>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->subject }}</a></td>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->createdBy->name }}</a></td>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->created_on }}</a></td>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->priority }}</a></td>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->category->name }}</a></td>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->classroom->name }}</a></td>
    </tr>
    @endforeach
    @else
    <p class="title">Žiaden ticket</p>
    @endif
    </tbody>
</table>

</x-app-layout>
