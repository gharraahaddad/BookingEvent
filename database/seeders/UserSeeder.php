<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $users=User::all();
        // $events=Event::all();
        //  foreach ($events as $event) {
        // $bookers = $users->random(rand(1, 3));
        // foreach ($bookers as $user) {
        //     Booking::factory()->create([
        //         'user_id' => $user->id,
        //         'event_id' => $event->id,
        //     ]);
    //     }
    // }
      User::factory(15)->create();
    }
}
