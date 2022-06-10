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


Route::prefix('v1')->group(function(){



    Route::prefix('events')->group(function(){


        //GET /api/v1/events/active-events -> Return all events that are active = current datetime is within startAt and endAt
        Route::get('active-events',[\App\Http\Controllers\EventController::class,'activeEvents']);




        //# restful routing by model base, more model no need to routing redo 1 by 1 or worst copy paste
        \App\Models\EventModel::setRestfulRouting();

    });

});