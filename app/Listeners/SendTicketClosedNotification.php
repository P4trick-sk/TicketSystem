<?php

namespace App\Listeners;

use App\Events\TicketClosed;
use App\Notifications\TicketClosedNotification;
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
        $user = $event->ticket->createdBy;
        $user->notify(new TicketClosedNotification($event->ticket));
    }
}
