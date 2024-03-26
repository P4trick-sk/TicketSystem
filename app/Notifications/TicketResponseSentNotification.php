<?php

namespace App\Notifications;

use App\Models\TicketResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketResponseSentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public TicketResponse $response;

    /**
     * Create a new notification instance.
     */
    public function __construct(TicketResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Nová odpoveď na ticket!')
            ->line("Užívateľ {$this->response->createdBy->name} odpovedal na ticket {$this->response->ticket->name}")
            ->action('Otvoriť', route('tickets.show', $this->response->ticket->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data_id' => $this->response->id,
            'url' => route('tickets.show', $this->response->ticket->id),
            'message' => "Nová odpoveď pre ticket ID: {$this->response->ticket->id}",
        ];
    }
}
