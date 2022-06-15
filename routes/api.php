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
// GET /api/v1/events/active-events -> Return all events that are active = current datetime is within startAt and endAt
// PUT /api/v1/events/{id} -> Create event if not exist, else update the event in idempotent way
// PATCH /api/v1/events/{id} -> Partially update event
// DELETE /api/v1/events/{id} -> Soft delete an event


Route::get("/v1/events", [App\Http\Controllers\API\V1\EventController::class, "index"])->name("event.index");
Route::get("/v1/events/active-event", [App\Http\Controllers\API\V1\EventController::class, "activeEvents"])->name("event.active-event");
Route::get("/v1/events/{id}", [App\Http\Controllers\API\V1\EventController::class, "show"])->name("event.show");
Route::post("/v1/events/{id}", [App\Http\Controllers\API\V1\EventController::class , "store"])->name("event.store");
Route::put("/v1/events/{id}", [App\Http\Controllers\API\V1\EventController::class , "updateOrCreate"])->name("event.update-create");
Route::patch("/v1/events/{id}", [App\Http\Controllers\API\V1\EventController::class , "update"])->name("event.update");
Route::delete("/v1/events/{id}", [App\Http\Controllers\API\V1\EventController::class , "destroy"])->name("event.destroy");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
