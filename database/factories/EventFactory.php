<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

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
        $fakerMy = FakerFactory::create('ms_MY');
        return [
            'id' => $this->faker->uuid(),
            'name' => $fakerMy->name(),
            'slug' => $this->faker->slug,
        ];
    }
}
