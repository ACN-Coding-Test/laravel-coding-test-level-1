<?php

use Illuminate\Http\Request;

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
  $router->get('events',  ['uses' => 'API\EventController@showAllEvent']);

  $router->get('active-events', ['uses' => 'API\EventController@showActiveEvent']);

  $router->get('events/{id}', ['uses' => 'API\EventController@showOneEvent']);

  $router->post('events',  ['uses' => 'API\EventController@save']);

  $router->put('events/{id}', ['uses' => 'API\EventController@put']);

  $router->patch('events/{id}', ['uses' => 'API\EventController@patch']);

  $router->delete('events/{id}', ['uses' => 'API\EventController@softDelete']);
});
