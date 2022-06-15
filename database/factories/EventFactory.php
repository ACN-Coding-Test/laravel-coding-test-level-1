<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
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
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = date('Y-m-d', strtotime( '-'.mt_rand(0,30).' days'));
        $endDate   = date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'));

        return [
            'id'        => Str::uuid()->toString(),
            'name'      => $this->faker->name(),
            'slug'      => $this->faker->unique()->slug(),
            'startAt'   => $startDate,
            'endAt'     => $endDate,
            'createdAt' => now()->toDateTimeString(),
            'updatedAt' => now()->toDateTimeString(),
        ];
    }
}
