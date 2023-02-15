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
        $created_at = fake()->dateTimeThisYear();
        $updated_at = strtotime('+1 Week', $created_at->getTimestamp());
        return [
            'name' => fake()->name(),
            'slug' => fake()->unique()->realText(),
            'createdAt' => $created_at,
            'updatedAt' => $updated_at,
        ];
    }
}
