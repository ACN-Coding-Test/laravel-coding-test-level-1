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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {

    //Retrieve event
    Route::get('/events',  [EventController::class, 'getAllEvents']);
    Route::get('/active-events', [EventController::class, 'getActiveEvents']);
    Route::get('/events/{id}', [EventController::class, 'getEventByID']);

    //Create event
    Route::post('/events', [EventController::class, 'addEvent']);

    //Update event
    Route::put('/events/{id}', [EventController::class, 'updateEvent']);

    //Delete event (softdeletes)
    Route::delete('/events/{id}', [EventController::class, 'deleteEvent']);
    
    //Patch event
    Route::patch('/events/{id}', [EventController::class, 'partialUpdateEvent']);

});