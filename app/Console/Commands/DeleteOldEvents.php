<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteOldEvents extends Command
{
     protected $signature = 'events:delete-old';

    protected $description = 'Delete events older than 30 days';
    public function handle()
    {
          $cutoffDate = Carbon::now()->subDays(30);

       $deletedCount=Event::whereDate('date', '<', Carbon::now()->subDays(30)->toDateString())->delete();


        $this->info("Deleted $deletedCount old events older than 30 days.");
    }
}
