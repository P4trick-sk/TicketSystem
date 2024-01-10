<?php

namespace App\Listeners;

use App\Events\TicketUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketUpdatedNotification
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
    public function handle(TicketUpdated $event): void
    {
        $userAssigned = $event->ticket->assignedTo;
        $userCreated = $event->ticket->createdBy;
        Mail::to($userAssigned)->send(new \App\Mail\TicketUpdated($event->ticket));
        Mail::to($userCreated)->send(new \App\Mail\TicketUpdated($event->ticket));
    }
}
