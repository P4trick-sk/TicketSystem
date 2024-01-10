<?php

namespace App\Listeners;

use App\Events\TicketResponseSent;
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
        $userAssigned = $event->response->ticket->assignedTo;
        $userCreated = $event->response->ticket->createdBy;
        Mail::to($userAssigned)->send(new \App\Mail\TicketResponseSent($event->response));
        Mail::to($userCreated)->send(new \App\Mail\TicketResponseSent($event->response));
    }
}
