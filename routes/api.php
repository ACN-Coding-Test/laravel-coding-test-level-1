<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

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

Route::get('/v1/events',[EventController::class, 'index']);
Route::get('/v1/events/active-events',[EventController::class, 'active']);
Route::get('/v1/events/{id}',[EventController::class, 'show']);
Route::get('/v1/event-search',[EventController::class, 'search']);

//auth
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']], function(){
    
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::post('/v1/events',[EventController::class, 'store']);
    Route::put('/v1/events/{id}',[EventController::class, 'createOrUpdate']);
    Route::patch('/v1/events/{id}',[EventController::class, 'update']);
    Route::delete('/v1/events/{id}',[EventController::class, 'destroy']);

});

