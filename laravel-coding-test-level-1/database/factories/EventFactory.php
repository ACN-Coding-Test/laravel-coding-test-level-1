<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EventFactory extends Factory
{
    public $timestamps = false;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'id' => fake()->uuid(),
            'name' => $name = fake()->name(),
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(2),
            'startAt' => $start= fake()->dateTimeBetween('today', 'today +7 days'),
            'endAt' => fake()->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days'),
            'createdAt' => now(),
            'updatedAt' => now()
        ];
    }
}
