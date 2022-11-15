<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
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
        Schema::disableForeignKeyConstraints();
        Event::truncate();
        Schema::enableForeignKeyConstraints();

        $events = [
            ['name' => 'Movie', 'slug' => 'movie'],
            ['name' => 'Swimming', 'slug' => 'swimming'],
            ['name' => 'Meeting', 'slug' => 'meeting'],
            ['name' => 'Sleeping', 'slug' => 'sleeping'],
            ['name' => 'Coding', 'slug' => 'coding']
        ];

        foreach ($events as $data) {
            Event::create($data);
        }
    }
}
