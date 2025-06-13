<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('ticket.{ticketId}', function ($user, $ticketId) {
    $ticket = App\Models\Ticket::find($ticketId);

    // Allow if user is the creator of the ticket
    if ($user->id === $ticket->created_by) {
        return true;
    }

    // Allow if user is assigned to the ticket
    if ($ticket->assignees->contains($user->id)) {
        return true;
    }

    // Allow if user is an admin or has specific permission
    return $user->hasRole('admin') || $user->can('view tickets');
});
