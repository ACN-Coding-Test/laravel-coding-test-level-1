<?php

use App\Http\Controllers\api\eventController;
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

Route::get('v1/events', [eventController::class,'allEvents']);
Route::post('v1/events', [eventController::class,'createEvents']);
Route::get('v1/events/active-events', [eventController::class,'activeEvents']);
Route::get('v1/events/{id}', [eventController::class,'searchEvents']);
Route::patch('v1/events/{id}', [eventController::class,'updateEvents']);
Route::put('v1/events/{id}', [eventController::class,'putEvents']);
Route::delete('v1/events/{id}', [eventController::class,'deleteEvents']);
