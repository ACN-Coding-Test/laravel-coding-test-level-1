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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Event API
$router->group(['prefix' => 'v1'], function () use ($router) {
    
  $router->get('events',  ['uses' => 'App\Http\Controllers\API\EventController@showAllEvent']);

  $router->get('active-events', ['uses' => 'App\Http\Controllers\API\EventController@showActiveEvent']);

  $router->get('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@showEvent']);

  $router->post('events',  ['uses' => 'App\Http\Controllers\API\EventController@save'])->middleware('auth');

  $router->put('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@put'])->middleware('auth');

  $router->patch('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@patch'])->middleware('auth');

  $router->delete('events/{id}', ['uses' => 'App\Http\Controllers\API\EventController@softDelete'])->middleware('auth');
});

