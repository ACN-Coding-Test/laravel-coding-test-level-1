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

        if(EventModel::count() <5){
            EventModel::factory()->count(5)->afterCreating(function($event){
                if($event->id == EventModel::orderBy('id','desc')->first()->id){

                    //# to make is expire
                    $event->endAt = now();
                    $event->save();
                }
            })->create();
        }
    }
}
