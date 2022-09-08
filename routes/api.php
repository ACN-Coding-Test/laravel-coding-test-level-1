<?php

use App\Http\Controllers\API\EventController;
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
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);



// Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function(){

Route::prefix('v1')->group(function () {

    Route::get('/events', [App\Http\Controllers\API\EventController::class, 'index']);
    Route::get('/events/active-events', [App\Http\Controllers\API\EventController::class, 'activeEvent']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/events', [App\Http\Controllers\API\EventController::class, 'store']);
        Route::put('/events/{event}', [App\Http\Controllers\API\EventController::class, 'update']);
        Route::patch('/events/{event}', [App\Http\Controllers\API\EventController::class, 'update']);
        Route::delete('/events/{event}', [App\Http\Controllers\API\EventController::class, 'delete']);
    });
    
    Route::get('/events/{event}', [App\Http\Controllers\API\EventController::class, 'show']);



    // Route::resource('/events', App\Http\Controllers\API\EventController::class);

});
