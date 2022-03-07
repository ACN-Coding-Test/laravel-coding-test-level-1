<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    Route::get('/events',[EventController::class, 'index']);
    Route::get('/events/active-events',[EventController::class, 'get_active_events']);
    Route::get('/events/{id}',[EventController::class, 'show']);
    Route::post('/events',[EventController::class, 'store']);
    Route::put('/events/{id}',[EventController::class, 'update']);
    Route::patch('/events/{id}',[EventController::class, 'patch']);
    Route::delete('/events/{id}',[EventController::class, 'destroy']);
});
