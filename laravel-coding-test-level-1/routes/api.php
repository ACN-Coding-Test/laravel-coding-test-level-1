<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes api prefix is set to prefix('api/v1') example request "api/v1/events"
Route::get('events', [EventController::class, 'index']);
Route::get('events/active-events', [EventController::class, 'getActive']);
Route::get('events/{id}', [EventController::class, 'show']);
Route::post('events', [EventController::class, 'store']);
Route::put('events/{id}', [EventController::class, 'put']);
Route::patch('events/{id}', [EventController::class, 'patch']);
Route::delete('events/{id}', [EventController::class, 'delete']);
