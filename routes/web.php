<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [EventController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/events',               [EventController::class, 'index']);
Route::get('/events/create',        [EventController::class, 'create']);
Route::get('/events/remote',        [EventController::class, 'remote']);
Route::get('/events/{event}',       [EventController::class, 'show']);
Route::post('/events',              [EventController::class, 'store']);
Route::get('/events/{event}/edit',  [EventController::class, 'edit']);
Route::put('/events/{event}',       [EventController::class, 'update']);
Route::delete('/events/{event}',    [EventController::class, 'destroy']);
