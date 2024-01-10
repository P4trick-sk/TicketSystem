<?php

namespace App\Providers;

use App\Events\TicketAssigned;
use App\Events\TicketClosed;
use App\Events\TicketResponseSent;
use App\Events\TicketUpdated;
use App\Listeners\SendTicketAssignedNotification;
use App\Listeners\SendTicketClosedNotification;
use App\Listeners\SendTicketResponseSentNotification;
use App\Listeners\SendTicketUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TicketAssigned::class => [
            SendTicketAssignedNotification::class,
        ],
        TicketClosed::class => [
            SendTicketClosedNotification::class,
        ],
        TicketResponseSent::class => [
            SendTicketResponseSentNotification::class,
        ],
        TicketUpdated::class => [
            SendTicketUpdatedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
