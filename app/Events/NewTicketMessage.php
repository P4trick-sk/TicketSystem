<?php

namespace App\Events;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTicketMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $ticket;
    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(TicketMessage $message, Ticket $ticket, User $user)
    {
        $this->message = $message;
        $this->ticket = $ticket;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ticket.' . $this->ticket->id),
        ];
    }

    /**
     * The data to broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'ticket' => [
                'id' => $this->ticket->id,
            ],
            'message' => [
                'id' => $this->message->id,
                'message' => $this->message->message,
                'created_at' => $this->message->created_at,
                'attachments' => $this->message->attachments,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
        ];
    }
}
