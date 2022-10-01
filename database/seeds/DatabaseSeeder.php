<?php

use Illuminate\Database\Seeder;
use App\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
   
        factory('App\Event', 5)->create();
    }
}
