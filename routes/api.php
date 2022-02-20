<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Resources\Event as EventResource;
use App\Models\Event;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace' => 'Event',
    'prefix' => 'v1/events',
    'as' => 'api.events.',
    // 'middleware' => 'auth:sanctum'
], function () {

    // Return all events from the database
    Route::get('/', [EventController::class, 'index']);

    // Return all events that are active
    Route::get('/active-events', [EventController::class, 'activeEvents']);

    // Return a single event
    Route::get('/{id}', [EventController::class, 'show']);

    // Create a new event
    Route::post('/', [EventController::class, 'store']);

    // Update an existing event, or create new event if it doesn't exist
    Route::put('/{id}', [EventController::class, 'update']);

    // Partially update an existing event
    Route::patch('/{id}', [EventController::class, 'update']);

    // Delete an existing event
    Route::delete('/{id}', [EventController::class, 'destroy']);
});
