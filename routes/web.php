<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ExternalApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'namespace' => 'Event',
    'prefix' => 'events',
    'as' => 'events.',
], function () {
    // Show all events
    Route::get('', [EventController::class, 'index'])->name('index');
    Route::get('create', [EventController::class, 'create'])->name('create')->middleware('auth');
    Route::post('store', [EventController::class, 'store'])->name('store')->middleware('auth');
    Route::patch('{id}/update', [EventController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('{id}/delete', [EventController::class, 'destroy'])->name('destroy')->middleware('auth');;
    Route::get('{id}', [EventController::class, 'show'])->name('show');
    Route::get('{id}/edit', [EventController::class, 'edit'])->name('edit')->middleware('auth');;

    // Redis
    Route::get('{id}/cached', [EventController::class, 'cachedEventView'])->name('cache');

    // External API
    // Route::get('api', [EventController::class, 'fetchExternalApi'])->name('api');
});

Route::group(
    [
        'namespace' => 'ExternalApi',
        'prefix' => 'externalapi',
        'as' => 'externalapi.',
    ],
    function () {
        Route::get('', [ExternalApiController::class, 'index'])->name('index');
    }
);
