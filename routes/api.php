<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\eventinfocontroller;
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


Route::prefix('v1')->group(function () {
    Route::get('events', [eventinfocontroller::class, 'events']);
    Route::get('active-events', [eventinfocontroller::class, 'activeevents']);
    Route::get('events/{id}', [eventinfocontroller::class, 'eventsinfo']);
    Route::post('events', [eventinfocontroller::class, 'eventsinfo']);
    Route::put('events/{id}', [eventinfocontroller::class, 'eventsinfo']);
    Route::patch('events/{id}', [eventinfocontroller::class, 'eventsinfo']);
    Route::delete('events/{id}', [eventinfocontroller::class, 'eventsinfo']);
});

