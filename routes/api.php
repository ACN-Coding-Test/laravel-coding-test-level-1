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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return 'test';
//     // return $request->user();
// });

// // Route::post('/login', 'API\AuthController@login')->name('login');
// // Route::group(['middleware' => 'jwt.auth'], function(){

// // });

Route::group(['prefix' => 'v1', 'as' => 'events.'], function ()
{
    Route::get('events', 'EventController@index')->name('list');
    Route::get('events/active-events', 'EventController@activeEvents')->name('active-events');
    Route::get('events/{id}', 'EventController@getEventById')->name('event-by-id');
    Route::post('events', 'EventController@create')->name('create');
    Route::put('events/{id}', 'EventController@eventUpdate')->name('update');
    Route::patch('events/{id}', 'EventController@edit')->name('edit');
    Route::delete('events/{id}', 'EventController@destroy')->name('delete');
});
