<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('events')->insert([

            [   
                'id' => Str::uuid()->toString(),
                'name' => 'Blackpink Consert',
                'created_at' => date('Y-m-d H:i:s'),
                'startAt' => date('Y-m-d H:i:s'),
                'endAt' => date('Y-m-d H:i:s'),
                'slug' => "1"
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Hackathon',
                'created_at' => date('Y-m-d H:i:s'),
                'startAt' => date('Y-m-d H:i:s'),
                'endAt' => date('Y-m-d H:i:s'),
                'slug' => "2"
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Summer Festival',
                'created_at' => date('Y-m-d H:i:s'),
                'startAt' => "2020-01-10 00:00:00",
                'endAt' => "2020-01-10 00:00:00",
                'slug' => "3"
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Halloween',
                'created_at' => date('Y-m-d H:i:s'),
                'startAt' => date('Y-m-d H:i:s'),
                'endAt' => date('Y-m-d H:i:s'),
                'slug' => "4"
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Lockdown',
                'created_at' => date('Y-m-d H:i:s'),
                'startAt' => "2021-01-10 00:00:00",
                'endAt' => "2021-11-11 00:00:00",
                'slug' => "5"
            ]

        ]);

        $events = Event::all();

        foreach($events as $event) {
            $event->slug = $event->name.'-'.$event->id;
            $event->save();
        }
    }
}
