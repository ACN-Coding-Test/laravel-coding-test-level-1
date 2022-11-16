<?php

namespace Database\Seeders;

use App\Models\Event;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 8; $i++) {
            $event = new Event();
            $eventName = $faker->catchPhrase();
            $event->name = ucwords($eventName);
            $event->slug = strtolower(str_replace(' ', '-', $eventName));
            $event->venue = $faker->streetAddress;
            $event->description = $faker->paragraph(2);

            $startAt = $faker->dateTimeBetween('-8 week', '+8 week');
            $event->start_at = $startAt;
            $event->end_at = $faker->dateTimeBetween($startAt, '+8 week');
            $event->save();
        }
    }
}
