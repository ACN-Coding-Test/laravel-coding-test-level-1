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
        $name = $this->faker->sentence();
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'createdAt' => $this->faker->dateTimeBetween('-1 week', 'now')->format('Y-m-d H:i:s'),
            'updatedAt' => $this->faker->dateTimeBetween('now', '+1 week')->format('Y-m-d H:i:s'),
        ];
    }
}
