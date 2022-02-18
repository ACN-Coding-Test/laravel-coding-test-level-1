<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
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
        $createdAt = $this->faker->dateTimeThisDecade('-3 years');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, Carbon::now());
        $startAt = $this->faker->dateTimeBetween($createdAt, '+5 years');
        $endAt = $this->faker->dateTimeBetween($startAt, '+5 years');

        return [
            'name' => $name,
            'slug' => $slug,
            'startAt' => $startAt,
            'endAt' => $endAt,
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt
        ];
    }
}
