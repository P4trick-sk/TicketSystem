<?php

namespace App\Providers;

use App\AttachmentsEnabledInterface;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Repositories\TicketRepository;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(AttachmentsEnabledInterface::class, Ticket::class);
        $this->app->bind(AttachmentsEnabledInterface::class, TicketResponse::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
