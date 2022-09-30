<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'events'], function()
{
    Route::get('/','EventsController@getEvents')->name('event.index');
    Route::post ('/create', 'EventsController@store')->name('event.store');
    Route::put ('/{id}/edit', 'EventsController@update')->name('event.update');
    Route::get ('/{id}', 'EventsController@show')->name('event.show');
    Route::delete ('/{id}/delete', 'EventsController@delete')->name('event.delete');

});
