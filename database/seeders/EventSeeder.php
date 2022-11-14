<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Event;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Party Glory',
                'slug' => 'party-glory',
                'startAt' => Carbon::now()->format('Y-m-d'),
                'endAt' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Fantasy Studio',
                'slug' => 'fantasy-studio',
                'startAt' => Carbon::now()->format('Y-m-d'),
                'endAt' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'A Wedding to Remember',
                'slug' => 'wedding-remember',
                'startAt' => Carbon::now()->format('Y-m-d'),
                'endAt' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Venue Kingdom',
                'slug' => 'venue-kingdom',
                'startAt' => Carbon::yesterday()->format('Y-m-d'),
                'endAt' => Carbon::yesterday()->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Events Empire',
                'slug' => 'events-empire',
                'startAt' => Carbon::yesterday()->format('Y-m-d'),
                'endAt' => Carbon::yesterday()->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Event::insert($events);
    }
}
