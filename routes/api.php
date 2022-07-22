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

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::get('/event', [App\Http\Controllers\API\EventController::class, 'index'])->name('event.index');
    Route::post('/createEvent', [App\Http\Controllers\API\EventController::class, 'store'])->name('event.store');
    Route::get('/oneEvent', [App\Http\Controllers\API\EventController::class, 'showEvent'])->name('event.showEvent');
    Route::delete('/deleteEvent', [App\Http\Controllers\API\EventController::class, 'deleteEvent'])->name('event.deleteEvent');
    Route::put('/checkEvent', [App\Http\Controllers\API\EventController::class, 'checkEvent'])->name('event.checkEvent');
    Route::patch('/updateEvent', [App\Http\Controllers\API\EventController::class, 'updateEvent'])->name('event.updateEvent');

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
