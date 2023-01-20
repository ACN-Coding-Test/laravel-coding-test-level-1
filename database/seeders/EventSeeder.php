<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $date = now()->format('Y-m-d H:i:s');
        $formated_date = Carbon::createFromFormat('Y-m-d H:i:s', $date);

        for($i = 0; $i < 10; $i++){
            $url = 'https://test1.com/test.';
            $value = $i + 1;
            DB::table('events')->insert([
                'id' => Str::uuid(),
                'name' => 'Event_'.$value,
                'slug' => Str::slug($url.$value),
                'start_at' => $formated_date->addDays($i - 2)->format('Y-m-d H:i:s'),
                'end_at' => $formated_date->addDays($i + 7)->format('Y-m-d H:i:s'),
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
