<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++)
        {
            $name = $faker->name;
            $slug = $this->slugify($name);

            //DB::table("events")->insert([
            Event::create([
                "name" => $name,
                "slug" => $slug
            ]);
        }
    }

    // Convert name/sentence to slug
    function slugify($str)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $str), '-'));
    }
}
