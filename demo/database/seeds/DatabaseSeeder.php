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
        $users = factory(App\User::class, 5)->make();
        $events = factory(App\Event::class, 10)->create();
    }
}
