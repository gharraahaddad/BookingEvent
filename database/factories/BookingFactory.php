<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
     protected $model = Booking::class;
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'event_id' => Event::all()->random()->id,
        ];
    }
}
