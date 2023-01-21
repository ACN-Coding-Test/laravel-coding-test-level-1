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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/events', [EventController::class, 'index']);
Route::get('v1/events/active-events', [EventController::class, 'indexActive']);
Route::get('v1/events/{id}', [EventController::class, 'show']);
Route::post('v1/events', [EventController::class, 'store']);
Route::put('v1/events/{id}', [EventController::class, 'updateCreate']);
Route::patch('v1/events/{id}', [EventController::class, 'update']);
Route::delete('v1/events/{id}', [EventController::class, 'destroy']);

