<?php

namespace App\Actions\Auth;

use App\Models\User;
use Laraditz\Action\Action;

class CreateUser extends Action
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ];
    }

    public function handle()
    {
        $user = User::create(
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password)
            ]
        );

        $token = $user->createToken('myToken')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
