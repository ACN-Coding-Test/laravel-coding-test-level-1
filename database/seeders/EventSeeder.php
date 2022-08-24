<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,10) as $event){
            $rand = rand(100,999);
            DB::table('events')->insert([
                'name' => 'Event '.$rand,
                'slug' => 'event-'.$rand,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
                'is_deleted' => 0
            ]);
        }
    }
}
