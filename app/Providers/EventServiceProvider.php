<?php

namespace App\Providers;

use App\Events\ResetPasswordEvent;
use App\Events\SetPasswordEvent;
use App\Listeners\ResetPasswordListener;
use App\Listeners\SetPasswordListener;
use App\Models\Product;
use App\Observers\InventoryObserver;
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

        SetPasswordEvent::class => [
            SetPasswordListener::class
        ],

        ResetPasswordEvent::class => [
            ResetPasswordListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(InventoryObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
