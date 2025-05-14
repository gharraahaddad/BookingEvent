<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
  protected $model = Event::class;
    public function definition(): array
    {
        return [
     'title' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
            'date' => Carbon::now()->addDays(rand(1, 60))->toDateString(),
            'capacity' => $this->faker->numberBetween(10, 1000),
            'image' => null,
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
