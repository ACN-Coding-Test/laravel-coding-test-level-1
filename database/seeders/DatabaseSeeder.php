<?php

namespace Database\Seeders;
use App\Models\event;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        
        
        for($i=0;$i<5;$i++)
        {
            $new= new event();
            $new->name='name'.(string)$i+1;
            $new->slug='name'.(string)$i+1;
            $new->startAt=now();
            $new->endAt=now();
        //    $new->deleted_at=now();
            $new->updated_at=now();
            $new->created_at=now();

            $new->save();
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
