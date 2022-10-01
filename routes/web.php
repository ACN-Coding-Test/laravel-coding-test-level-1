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

Route::prefix('events')->group(function ($router) {
    $router->get('/', 'EventsController@events');
    $router->get('/create', 'EventsController@create');
    $router->get('/{id}/edit', 'EventsController@edit');
    $router->get('/{id}', 'EventsController@view');
    $router->get('/{id}/delete', 'EventsController@delete');
});