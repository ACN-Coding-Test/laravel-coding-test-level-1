<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('welcome');
});

/* 1-crud-api */
Route::get('/api/v1/events', [EventController::class, 'all_events']);
Route::get('/api/v1/events/active-events', [EventController::class, 'active_events']);
Route::post('/api/v1/events', [EventController::class, 'create_event']);
Route::match( [ 'put', 'delete', 'get' ], '/api/v1/events/{id}', [EventController::class, 'event']);

/* 2-ui */

Route::get('/events', [EventController::class, 'events']);