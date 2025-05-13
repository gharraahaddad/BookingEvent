<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\BookingCreated;
use App\Listeners\LogBookingCreated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BookingCreated::class => [
            LogBookingCreated::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
