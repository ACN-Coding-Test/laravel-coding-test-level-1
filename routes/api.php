<?php

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


Route::get('events', [App\Http\Controllers\Api\V1\EventController::class, 'index']);
Route::get('events/active-events', [App\Http\Controllers\Api\V1\EventController::class, 'getActiveEvents']);
Route::get('events/{event}', [App\Http\Controllers\Api\V1\EventController::class, 'show']);

Route::middleware('auth:api')->group( function () {
    Route::put('events/{event?}', [App\Http\Controllers\Api\V1\EventController::class, 'createOrUpdate']);
    Route::patch('events/{event}', [App\Http\Controllers\Api\V1\EventController::class, 'update']);
    Route::post('events', [App\Http\Controllers\Api\V1\EventController::class, 'store']);
    Route::delete('events/{event}', [App\Http\Controllers\Api\V1\EventController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
