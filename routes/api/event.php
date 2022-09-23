<?php

use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;


Route::prefix('events')->group(function ($router) {
    $router->get('/', [EventController::class, 'index']);
    $router->get('/active-events', [EventController::class, 'getActive']);
    $router->post('/', [EventController::class, 'store']);
    $router->get('/{id}', [EventController::class, 'show']);
    $router->put('/{id}', [EventController::class, 'put']);
    $router->patch('/{id}', [EventController::class, 'patch']);
    $router->delete('/{id}', [EventController::class, 'destroy']);
});
