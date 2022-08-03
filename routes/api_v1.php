<?php

use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('/events')->group( function() {
    Route::get('/', [EventController::class, 'index']);
    Route::get('active-events', [EventController::class, 'getActiveEvents']);
    Route::get('{id}', [EventController::class, 'show']);
    Route::post('/', [EventController::class, 'store']);
    Route::put('{id?}', [EventController::class, 'update']);
    Route::patch('{id?}', [EventController::class, 'updateEvent']);
});
