<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\EventController;
use App\Models\Event;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */

 // 1. Return all events from the database
Route::get('v1/events', function() {
    return Event::all();
});

// 2. Return all events that are active = current datetime is within startAt and endAt
Route::get('v1/events/active-events', function() {
	if (request()->startAt && request()->endAt) {
		$startAt = Carbon::parse(request()->startAt)->toDateTimeString();
        $endAt = Carbon::parse(request()->endAt)->toDateTimeString();
		$data = Event::whereBetween('createdAt', [$startAt, $endAt])->get();
	} else {
        // Missing either parameter, return nothing
		$data = [];
	}
	
    return $data;
});

// 3. Get one event
Route::get('v1/events/{id}', function($id) {
    return Event::find($id);
});

// 4. Create an event
Route::post('v1/events', [EventController::class, 'apiStore']);

// 5. Create event if not exist, else update the event in idempotent way
Route::put('v1/events/{id}', [EventController::class, 'apiUpdate']);

// 6.  Partially update event
Route::patch('v1/events/{id}', [EventController::class, 'apiUpdate']);

// 7. Soft delete an event
Route::delete('v1/events/{id}', [EventController::class, 'apiDelete']);
