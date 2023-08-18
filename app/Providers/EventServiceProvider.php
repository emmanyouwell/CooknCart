<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\OrderCreated;
use App\Events\OrderCancelled;
use App\Events\OrderUpdated;
use App\Listeners\SendCancelNotification;
use App\Listeners\SendUpdateNotification;
use App\Listeners\SendUserNotification;
use App\Listeners\SendAdminNotification;
use App\Listeners\SendAdminCancelNotification;


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
        OrderCreated::class =>[
            SendUserNotification::class,
            SendAdminNotification::class
        ],
        OrderCancelled::class => [
            SendCancelNotification::class,
            SendAdminCancelNotification::class,
        ],
        OrderUpdated::class => [
            SendUpdateNotification::class,
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
