<?php

namespace App\Livewire;

use App\Events\NewTicketMessage;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

class TicketConversation extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $message = '';
    public $attachments = [];

    protected $listeners = ['echo:ticket.*,NewTicketMessage' => 'handleNewMessage'];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Handles a new message event for the ticket conversation.
     *
     * This method listens for the `NewTicketMessage` event and checks if the event's ticket ID
     * matches the current ticket's ID. If they match, it refreshes the ticket instance to
     * retrieve the latest messages and associated user data.
     *
     * @param array $event The event data containing the ticket information.
     * @return void
     */
    public function handleNewMessage($event)
    {
        if ($event['ticket']['id'] === $this->ticket->id) {
            // Refresh the ticket to get the latest messages
            $this->ticket = $this->ticket->fresh(['messages.user']);
        }
    }

    /**
     * Sends a message in the ticket conversation.
     *
     * This method validates the input, processes attachments, creates a new message
     * associated with the ticket, clears the form, broadcasts the message to other users,
     * and emits an event to scroll the conversation to the bottom.
     *
     * @return void
     */
    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // 10MB max file size
        ]);

        $attachmentPaths = [];
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                $attachmentPaths[] = $attachment->store('ticket-attachments', 'public');
            }
        }

        $message = $this->ticket->messages()->create([
            'user_id' => auth()->id(),
            'message' => $this->message,
            //'attachments' => $attachmentPaths,
        ]);

        // Clear the form
        $this->reset('message', 'attachments');

        // Broadcast the message
        broadcast(new NewTicketMessage($message, $this->ticket, auth()->user()))->toOthers();

        // Emit an event to scroll to the bottom
        $this->dispatch('messageSent');
    }

    public function render()
    {
        return view('livewire.ticket-conversation');
    }
}
