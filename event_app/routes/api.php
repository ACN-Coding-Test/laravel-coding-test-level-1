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


Route::prefix('events')->group(function () {
    Route::get('', [EventController::class, 'index'])->name('api.event.index');
    Route::get('active-events', [EventController::class, 'activeEvents'])
        ->name('api.event.active-events');
    Route::get('{id}', [EventController::class, 'show'])->name('api.event.show');
    Route::post('', [EventController::class, 'store'])->name('api.event.store');
    Route::patch('{id}', [EventController::class, 'edit'])->name('api.event.patch');
    Route::put('{id}', [EventController::class, 'update'])->name('api.event.update');
    Route::delete('{id}', [EventController::class, 'destroy'])->name('api.event.delete');
});
