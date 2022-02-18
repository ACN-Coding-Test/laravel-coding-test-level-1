<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $slug = Str::slug($name, '-');
        $createdAt = $this->faker->dateTime;
        $updatedAt = $this->faker->dateTime;

        return [
            'name' => $name,
            'slug' => $slug,
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt
        ];
    }
}
