<?php

namespace Database\Seeders;

use App\Models\EventModel;
use Illuminate\Database\Seeder;

class EventSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        if(EventModel::count() <200){
            EventModel::factory()->count(200)->afterCreating(function($event){
                if($event->id > 5){

                    //# to make is expire
                    $event->endAt = now();
                    $event->save();
                }
            })->create();
        }
    }
}
