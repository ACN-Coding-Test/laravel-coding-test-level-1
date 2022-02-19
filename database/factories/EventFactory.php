<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Event::class;




    public function definition()
    {
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
    }
}
