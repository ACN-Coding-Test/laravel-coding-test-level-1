<?php

use App\Http\Controllers\Api\EventController;
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

Route::prefix('v1/events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('all');
    Route::get('/active-events', [EventController::class, 'active'])->name('active');
    Route::get('/{id}', [EventController::class, 'get'])->name('get');
    Route::post('/', [EventController::class, 'store'])->name('post');
    Route::put('/', [EventController::class, 'put'])->name('put');
    Route::patch('/{id}', [EventController::class, 'patch'])->name('patch');
    Route::delete('/{id}', [EventController::class, 'delete'])->name('delete');
});
