<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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
//     return $request->user();
// });

$prefixtext = 'v1/events';
Route::group(['prefix' => $prefixtext], function ($router) {
    $router->get('/', [EventController::class, 'index'])->name('events.index'); // Return All Event API
    $router->get('/active-events', [EventController::class, 'active_events'])->name('active-events');   // Return active Events API  
    $router->get('/{id}', [EventController::class, 'get_event'])->name('get_event');   // Get one event API  
    $router->post('/', [EventController::class, 'create_event'])->name('create_event');   // Create an event API  
    $router->put('/{id}', [EventController::class, 'update_event'])->name('update_event');   // Create event if not exist, else update the event API  
    $router->patch('/{id}', [EventController::class, 'update_event'])->name('update_event');   // Partially update event API  
    $router->delete('/{id}', [EventController::class, 'delete_event'])->name('delete_event');   // Soft delete an event API  
});