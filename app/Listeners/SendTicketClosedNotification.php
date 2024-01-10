<?php

namespace App\Listeners;

use App\Events\TicketClosed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketClosedNotification
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
    public function handle(TicketClosed $event): void
    {
        $userAssigned = $event->ticket->assignedTo;
        $userCreated = $event->ticket->createdBy;
        Mail::to($userAssigned)->send(new \App\Mail\TicketClosed($event->ticket));
        Mail::to($userCreated)->send(new \App\Mail\TicketClosed($event->ticket));
    }
}
