<?php

use App\Http\Controllers\Eventapi;
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
Route::prefix('/v1')->name('eventAPI')->group(function(){
    // GET /api/v1/events -> Return all events from the database
    Route::get('/events',[Eventapi::class,'index'])->name('index');
    // GET /api/v1/events/active-events -> Return all events that are active = current datetime is within startAt and endAt
    Route::get('/events/active-events',[Eventapi::class,'getActive'])->name('getActive');
    // GET /api/v1/events/{id} -> Get one event
    Route::get('/events/{id}',[Eventapi::class,'show'])->name('show');
    // POST /api/v1/events -> Create an event
    Route::post('/events',[Eventapi::class,'store'])->name('store');
    // PUT /api/v1/events/{id} -> Create event if not exist, else update the event in idempotent way
    Route::put('/events/{id}',[Eventapi::class,'updateOrCreate'])->name('updateOrCreate');
    // PATCH /api/v1/events/{id} -> Partially update event
    Route::patch('/events/{id}',[Eventapi::class,'updateEventPartially'])->name('updateEventPartially');
    // DELETE /api/v1/events/{id} -> Soft delete an event
    Route::delete('/events/{id}',[Eventapi::class,'destroy'])->name('destroy');
});
