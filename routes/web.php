<?php

use Illuminate\Support\Facades\Route;

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


Route::resource('events','App\Http\Controllers\EventController');

Route::get('/search/', 'App\Http\Controllers\EventController@search')->name('search');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
