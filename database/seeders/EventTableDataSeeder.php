<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Event;

class EventTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 5; $i++) { 
            $name = $faker->name;
            $slug = Str::slug($name);
            
	    	Event::create([
                "name" => $name,
                "slug" => $slug
	        ]);
    	}
    }
}
