<?php

use Illuminate\Database\Seeder;
use App\Event;
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
        DB::table('events')->delete();

        for ($i=0; $i < 5; $i++) { 
            DB::table('events')->insert([
                'id' => (string) Str::uuid(),
                'name' => 'Event '.$i,
                'slug' => 'event-'.$i,
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
