<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(2);
        $slug = Str::slug($name);
        return [
                'id' => $this->faker->uuid(),
                'name' => $name,
                'slug' => $slug,
                'start_at' => $this->faker->dateTimeBetween('-5 days', '+5 days'),
                'end_at' => $this->faker->dateTimeBetween('+6 days', '+10 days'),
        ];
    }
}
