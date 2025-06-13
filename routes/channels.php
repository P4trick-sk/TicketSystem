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
    // Check if user is authorized to listen to this ticket's channel
    // You might want to check if the user is the ticket creator or an assignee
    return \App\Models\Ticket::where('id', $ticketId)
        ->where(function($query) use ($user) {
            $query->where('created_by', $user->id)
                  ->orWhereHas('assignees', function($q) use ($user) {
                      $q->where('users.id', $user->id);
                  });
        })
        ->exists();
});
