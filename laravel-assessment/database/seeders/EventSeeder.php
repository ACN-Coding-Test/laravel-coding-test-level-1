<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use DB;

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
        
        $events = [
            ["name" => "Best Friend Vacation",  "startAt" => "2022-01-02 16:42:13", "endAt" => "2022-01-05 16:42:13"],
            ["name" => "Honeymoon",             "startAt" => "2022-01-01 16:42:13", "endAt" => "2022-04-01 16:42:13"],
            ["name" => "New Year",              "startAt" => "2022-01-02 16:42:13", "endAt" => "2022-01-01 16:42:13"],
            ["name" => "Close Friend Vacation", "startAt" => "2022-02-02 16:42:13", "endAt" => "2022-04-05 16:42:13"],
            ["name" => "Long Vacation",         "startAt" => "2022-01-02 16:42:13", "endAt" => "2022-12-02 16:42:13"],
        ];
        
        foreach($events as $event){
            Event::create($event);
        }
    }
}
