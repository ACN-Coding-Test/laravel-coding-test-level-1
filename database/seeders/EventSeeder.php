<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 1; $i <= 20; $i++){
            $title = $faker->sentence;
            $slug = Str::slug($title);
            $now=Carbon::now();
            $starts_at = Carbon::createFromTimestamp($faker->dateTimeBetween($startDate = '+2 days', $endDate = '+1 week')->getTimeStamp()) ;
            $ends_at= Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours( $faker->numberBetween( 1, 8 ) );

            DB::table('events')->insert([
                'id' => $faker->uuid,
                'name' => $faker->name,
                'slug' => $slug,
                'created_at' => $now,
                'updated_at' => $now,
                'startAt' => $starts_at,
                'endAt' => $ends_at
            ]);
        }
    }
}
