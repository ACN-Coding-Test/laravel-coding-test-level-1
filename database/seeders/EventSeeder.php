<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{

    //use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'id' => rand(0,10),
            'name' => 'seed'.Str::random(5).'@gmail.com',
            'slug' => 'seed'.Str::random(5),
            'createdAt' => Carbon::now()->format('Y-m-d H:i:s'),
            'updatedAt' => Carbon::now()->format('Y-m-d H:i:s'),
            'startAt' => Carbon::now()->format('Y-m-d H:i:s'),
            'endAt' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
