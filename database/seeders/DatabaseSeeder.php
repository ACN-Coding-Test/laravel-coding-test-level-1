<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\admin;
use App\Models\accenture;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
      /*   admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret')
        ]);
       */
      accenture::create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);
        
    }
}
