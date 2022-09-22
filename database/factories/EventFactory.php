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
            //
            $name = $this->faker->name();
            $slug = Str::slug($name, '-');
    
            return [
                'name' => $name,
                'slug' => $slug
            ];
        ];
    }
}
