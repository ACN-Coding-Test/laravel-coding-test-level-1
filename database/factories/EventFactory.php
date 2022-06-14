<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique()->asciify('********************'),
            'startAt' => now(),
            'endAt' => now(),
            'createdAt' => now(),
            'updatedAt' => now()
        ];
    }
}
