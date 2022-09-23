<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseApiController
{
    /**
     * @param AuthRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRegisterRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['password'] = Hash::make($validated_data['password']);

        $user = User::create($validated_data);

        $token = $user->createToken('user_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->sendResponse($response, 201);
    }

    /**
     * @param AuthLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->sendError('Credentials do not match', 422);
        }

        $token = Auth::user()->createToken('user_token')->plainTextToken;

        $response = [
            'token' => $token,
        ];

        return $this->sendResponse($response, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){

        auth()->user()->tokens()->delete();

        return $this->sendResponse([], 200);
    }
}
