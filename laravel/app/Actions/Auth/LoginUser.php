<?php

namespace App\Actions\Auth;

use App\Exceptions\GeneralHttpException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laraditz\Action\Action;

class LoginUser extends Action
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function handle()
    {
        $user = User::whereEmail($this->email)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            throw new GeneralHttpException('Wrong Email or Password');
        }

        $token = $user->createToken('myToken')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
