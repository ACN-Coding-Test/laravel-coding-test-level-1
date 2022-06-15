<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = factory(Event::class, 5)->make()->toArray();

        foreach ($events as $event) {
            App\Event::create($event);
        }

    }
}
