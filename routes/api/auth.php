<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function ($router) {
    $router->post('login', [AuthController::class, 'login']);
    $router->post('register', [AuthController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->group(function ($router) {
    $router->prefix('auth')->group(function ($router) {
        $router->post('logout', [AuthController::class, 'logout']);
    });
});