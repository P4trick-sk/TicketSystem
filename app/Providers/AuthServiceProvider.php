<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use App\Policies\ProfilePolicy;
use App\Policies\TicketPolicy;
use App\Policies\TicketResponsePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Ticket::class => TicketPolicy::class,
        TicketResponse::class => TicketResponsePolicy::class,
        User::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
