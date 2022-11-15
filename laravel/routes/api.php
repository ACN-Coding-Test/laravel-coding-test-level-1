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

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'events'], function () use ($router) {
        $ctlr = App\Http\Controllers\Api\EventController::class.'@';

        $router->get('/', $ctlr . 'index');
        $router->get('/active-events', $ctlr . 'activeEvent');
        $router->get('/{id}', $ctlr . 'show');
        $router->post('/', $ctlr . 'create');
        $router->patch('/{id}', $ctlr . 'update');
        $router->delete('/{id}', $ctlr . 'delete');
    });
});



