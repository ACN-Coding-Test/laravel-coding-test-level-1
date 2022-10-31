<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        for($i=0;$i<5;$i++)
        {
            $new= new Event();

            $new->name="Api_".(string)$i+1;
            $new->slug="Slug_".(string)$i+1;
            $new->createdAt=now();
            $new->updatedAt=now();
    
            $new->save();
        }
      


        
        
    }
}
