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
            $start_at = Carbon::now();
            $end_at = Carbon::now()->addDays(2);
    
            return [
                'name' => $name,
                'slug' => $slug,
                'start_at' => $start_at,
                'end_at' => $end_at
            ];
        ];
    }
}
