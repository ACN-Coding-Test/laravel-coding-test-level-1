<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

class EventModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = \Illuminate\Support\Str::limit($this->faker->paragraph,20) . rand(1111,9999);
        $title = trim($title);
        return [
            'name' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'created_at' => now(),
            'startAt' => now(),
            'endAt' => now()->addYears(20),
        ];
    }
}
