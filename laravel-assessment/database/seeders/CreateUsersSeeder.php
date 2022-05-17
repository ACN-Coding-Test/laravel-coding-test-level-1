<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        
        $users = [
            ["name" => "Admin",  "email" => "admin@laravel.com", "is_admin" => "1", 'password'=> bcrypt('admin')],
            ["name" => "Normal",  "email" => "normal@laravel.com", "is_admin" => "0", 'password'=> bcrypt('normal')],
        ];
        
        foreach($users as $user){
            User::create($user);
        }
    }
}
