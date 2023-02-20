<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(EventController::class)->prefix('v1')->group(function() {
    Route::get('events', 'index');
    // Return all events that are active = current datetime is within startAt and endAt
    Route::get('events/active-events', 'getActiveEvents');
    Route::get('events/{id}', 'show');

    Route::post('events', 'store');
    // Create event if not exist, else update the event in idempotent way
    Route::put('events/{id}', 'updateOrCreateEvent');
    // Partially update event
    Route::patch('events/{id}', 'update');
    Route::delete('events/{id}', 'destroy');
});
