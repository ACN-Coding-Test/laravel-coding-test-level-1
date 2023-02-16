<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;

    public function definition(): array
    {
        $startAt = fake()->dateTimeBetween('-3 day', '+1 day');
        $endAt = strtotime('+1 Week', $startAt->getTimestamp());

        $createdAt = fake()->dateTimeThisYear();
        $updatedAt = strtotime('+1 Week', $createdAt->getTimestamp());
        return [
            'name' => fake()->name(),
            'slug' => fake()->unique()->realText(),
            'startAt' => $startAt,
            'endAt' => $endAt,
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt,
        ];
    }
}
