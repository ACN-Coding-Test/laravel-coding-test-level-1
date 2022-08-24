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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/events','App\Http\Controllers\Api\V1\EventController@index');
Route::get('/v1/events/active-events','App\Http\Controllers\Api\V1\EventController@activeEvents');
Route::get('/v1/events/{id}','App\Http\Controllers\Api\V1\EventController@show');
Route::post('/v1/events/store','App\Http\Controllers\Api\V1\EventController@store');
Route::patch('/v1/events/{id}','App\Http\Controllers\Api\V1\EventController@update');
Route::delete('/v1/events/{id}','App\Http\Controllers\Api\V1\EventController@destroy');
