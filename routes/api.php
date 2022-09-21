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


//Event API
$router->group(['prefix' => 'v1'], function () use ($router) {
    
  $router->get('events',  ['uses' => 'App\Http\Controllers\API\EventController@showAllEvent']);

  $router->get('active-events', ['uses' => 'App\Http\Controllers\API\EventController@showActiveEvent']);

  $router->get('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@showEvent']);

  $router->post('events',  ['uses' => 'App\Http\Controllers\API\EventController@save']);

  $router->put('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@put']);

  $router->patch('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@patch']);

  $router->delete('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@softDelete']);
});

