<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\PassportAuthController;
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

Route::prefix('v1')->group(function () {
    Route::post('register', [PassportAuthController::class, 'register']);
    Route::post('login', [PassportAuthController::class, 'login']);

    Route::get('events/active-events', [EventController::class, 'active_events']);
    Route::resource('events',EventController::class)->except([
        'create','edit'
    ]);
});

