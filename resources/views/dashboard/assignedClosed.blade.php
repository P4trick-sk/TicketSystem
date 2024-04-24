<x-app-layout>
    @if($tickets->first())
    <table class="tickets">
        <thead>
        <tr>
            <th>Predmet</th>
            <th>Vytvoril</th>
            <th>Vytvorené</th>
            <th>Dátum zatvorenia</th>
            <th>Priorita</th>
            <th>Kategória</th>
            <th>Učebňa</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->subject }}</a></td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->createdBy->name }}</a></td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->created_on }}</a></td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->deleted_at }}</a></td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->priority }}</a></td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->category?->name }}</a></td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->classroom?->name }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <div class="pt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $tickets->links() }}
            </div>
        </div>
    @else
        <p class="title">Žiaden ticket</p>
    @endif

</x-app-layout>
