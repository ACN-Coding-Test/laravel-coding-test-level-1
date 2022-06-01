<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsApiController;

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


Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::get('/events/active-events', 'App\Http\Controllers\EventsApiController@activeEvents');
    Route::apiResource('/events', 'App\Http\Controllers\EventsApiController');
    
});