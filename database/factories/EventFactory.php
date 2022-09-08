<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'id' => $this->faker->uuid(),
            'name' => $this->faker->text(),
            'slug' => $this->faker->unique()->slug(),
            'start_at' => $this->faker->dateTimeInInterval(now(), '+10 days'),
            'end_at' => $this->faker->dateTimeInInterval('+11 days', '+20 days'),
        ];
    }
}
