<?php

namespace App\Listeners;

use App\Events\TicketResponseSent;
use App\Notifications\TicketResponseSentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketResponseSentNotification
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
    public function handle(TicketResponseSent $event): void
    {
        if ($event->response->createdBy->id == $event->response->ticket->assignedTo->id) {
            $event->response->ticket->createdBy->notify(new TicketResponseSentNotification($event->response));
        } elseif ($event->response->createdBy->id == $event->response->ticket->createdBy->id) {
            $event->response->ticket->assignedTo->notify(new TicketResponseSentNotification($event->response));
        } else {
            $event->response->ticket->assignedTo->notify(new TicketResponseSentNotification($event->response));
            $event->response->ticket->createdBy->notify(new TicketResponseSentNotification($event->response));
        }
    }
}
