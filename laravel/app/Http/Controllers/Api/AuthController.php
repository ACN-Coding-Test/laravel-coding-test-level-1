<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginUser;
use App\Actions\Users\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return $this->apiResponse->created(new AuthResource(CreateUser::dispatch($request->all())));
    }

    public function login(Request $request)
    {
        return $this->apiResponse->created(new AuthResource(LoginUser::dispatch($request->all())));
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Successfully Logout.'
        ];
    }
}
