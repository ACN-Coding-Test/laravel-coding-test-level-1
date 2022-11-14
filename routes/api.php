<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventController;

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
Route::prefix('v1')->group(function () {
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('api.events.index');
        Route::get('/active-events', [EventController::class, 'active'])->name('api.events.active');
        Route::get('/{id}', [EventController::class, 'show'])->name('api.events.show');
        Route::post('/', [EventController::class, 'store'])->name('api.events.store');
        Route::put('/{id}', [EventController::class, 'update'])->name('api.events.update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('api.events.destroy');
    });
});
