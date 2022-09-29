<?php

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
        $count = 0;
        for ($i=0; $i < 5; $i++) { 
        DB::table('events')->insert([
            'name' => 'Event'.' '. $count++,
            'slug' => Str::random(20),
        ]);
    }
    }
}
