<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++){
            DB::table('events')->insert([
                'id' => Str::uuid(),
                'name' => 'Event Testing '.$i,
                'slug' => 'event_testing_'.$i,
                'created_at' => date('Y-m-d H:i:s'),
                'startAt' => date('Y-m-d H:i:s'),
                'endAt' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
