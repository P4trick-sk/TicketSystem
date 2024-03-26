<?php

namespace App\Listeners;

use App\Events\TicketAssigned;
use App\Notifications\TicketAssignedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketAssignedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketAssigned $event): void
    {
        $user = $event->ticket->assignedTo;
        $user->notify(new TicketAssignedNotification($event->ticket));
    }
}
