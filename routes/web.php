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

Route::get('/events', [EventController::class,'events'])->name('events');
Route::post('/events/create',[EventController::class,'newEvent'])->name('newEvent');
Route::post('/events/{id}/edit',[EventController::class,'updateEvent'])->name('updateEvent');
Route::delete('/events/{id}',[EventController::class,'destroyEvent'])->name('destroyEvent');