<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // EventSeeder::factory(5)->create();
        $this->call([
            EventSeeder::class,
        ]);
    }
}
