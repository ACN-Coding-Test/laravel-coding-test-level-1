<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $fields = $request->validate([
            'name' => 'required | string',
            'email' => 'required | string | unique:users',
            'password' => 'required | min:6 | string | confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        
        // Mail::to($fields['email'])->send(new RegisteredMail($user));

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        //check username
        $user = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message'=>'Bad credentials'
            ],401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();

        return [ 'message'=>'Logged out'];
    }
}
