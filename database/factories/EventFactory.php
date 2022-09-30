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
        $name = fake()->words(3, true);
        $slug = Str::slug($name,'-');
        $date = fake()->dateTimeBetween($startDate = 'now', $endDate = '1 year')->format('Y-m-d');
        $start = fake()->time($format = 'H:i:s', $max = 'now'); 

        return [
            'name' => $name,
            'slug' => $slug,
            'startAt' => $date.' '.$start,
            'endAt' => $date.' 23:59:59'
        ];
    }
}
