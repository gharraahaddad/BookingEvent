<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEventReminders extends Command
{
      protected $signature = 'events:send-reminders';

    protected $description = 'Send reminders (log entry) to users who have events tomorrow';

    public function handle()
    {
          $tomorrow = now()->addDay()->toDateString();

        $events = Event::whereDate('date', $tomorrow)->with('users')->get();

        foreach ($events as $event) {
            foreach ($event->users as $user) {
                Log::info("Reminder: User {$user->id} has an event '{$event->title}' tomorrow ({$event->date})");
            }
        }

        $this->info('Reminders logged successfully.');

    }
}
