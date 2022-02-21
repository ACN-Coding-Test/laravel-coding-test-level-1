<?php

namespace Database\Seeders;
use DB;
use Illuminate\Support\Str;


use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = \Faker\Factory::create();
        for ($i=0; $i < 5; $i++) { 
            $name = $faker->name;
            $slug = Str::slug($name);

	    	DB::table('events')->insert([
                'name' =>  $name.Str::random(3)            ,
                'slug' => $slug.Str::random(3)            ,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
    	}
      
    }


    
}
