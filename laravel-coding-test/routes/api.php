<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

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
    Route::get('/events',  [EventController::class, 'getAllEvents'])->name('events.get-all-events');
    Route::get('/active-events', [EventController::class, 'getActiveEvents'])->name('events.get-active-events');
    Route::get('/events/{id}', [EventController::class, 'getEventByID'])->name('events.get-events-by-id');

    //Create event
    Route::post('/events', [EventController::class, 'addEvent'])->name('events.add-events');

    //Update event
    Route::put('/events/{id}', [EventController::class, 'updateEvent'])->name('events.update-events');

    //Delete event (softdeletes)
    Route::delete('/events/{id}', [EventController::class, 'deleteEvent'])->name('events.delete-events');
    
    //Patch event
    Route::patch('/events/{id}', [EventController::class, 'partialUpdateEvent'])->name('events.partial-update-events');

});