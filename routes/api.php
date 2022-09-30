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

Route::prefix('/v1')->name('eventAPI')->group(function(){
    // GET /api/v1/events -> Return all events from the database
    Route::get('/events',[EventController::class,'getEvents'])->name('getEvents');
    // GET /api/v1/events/active-events -> Return all events that are active = current datetime is within startAt and endAt
    Route::get('/events/active-events',[EventController::class,'getEventsByStatus'])->name('getEventsByStatus');
    // GET /api/v1/events/{id} -> Get one event
    Route::get('/events/{id}',[EventController::class,'getEventById'])->name('getEventById');
    // POST /api/v1/events -> Create an event
    Route::post('/events',[EventController::class,'createEvent'])->name('createEvent');
    // PUT /api/v1/events/{id} -> Create event if not exist, else update the event in idempotent way
    Route::put('/events/{id}',[EventController::class,'updateOrCreate'])->name('updateOrCreate');
    // PATCH /api/v1/events/{id} -> Partially update event
    Route::patch('/events/{id}',[EventController::class,'updateEventPartially'])->name('updateEventPartially');
    // DELETE /api/v1/events/{id} -> Soft delete an event
    Route::delete('/events/{id}',[EventController::class,'deleteEvent'])->name('deleteEvent');
});