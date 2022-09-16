<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'id' => Str::uuid(),
            'name' => 'Event 1',
            'slug' => 'event1',
            'startAt' => Carbon::today(),
            'endAt' => Carbon::tomorrow(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('events')->insert([
            'id' => Str::uuid(),
            'name' => 'Event 2',
            'slug' => 'event2',
            'startAt' => Carbon::today(),
            'endAt' => Carbon::tomorrow(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('events')->insert([
            'id' => Str::uuid(),
            'name' => 'Event 3',
            'slug' => 'event3',
            'startAt' => Carbon::now(),
            'endAt' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('events')->insert([
            'id' => Str::uuid(),
            'name' => 'Event 4',
            'slug' => 'event4',
            'startAt' => Carbon::now(),
            'endAt' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('events')->insert([
            'id' => Str::uuid(),
            'name' => 'Event 5',
            'slug' => 'event5',
            'startAt' => Carbon::now(),
            'endAt' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);
    }
}
