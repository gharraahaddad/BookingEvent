<?php

namespace App\Listeners;

use App\Events\BookingCreated;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class LogBookingCreated
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
    public function handle(BookingCreated $event): void
    {
         Log::info('New booking created by user ID: ' . $event->booking->user_id);

    }
}
