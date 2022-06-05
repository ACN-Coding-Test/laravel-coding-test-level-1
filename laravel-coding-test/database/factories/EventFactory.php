<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->text(10),
            'createdAt' => now(),
            'updatedAt' => now(),
            'startAt' => null,
            'endAt' => null,
            'deleted_at' => null,
        ];
    }
}
