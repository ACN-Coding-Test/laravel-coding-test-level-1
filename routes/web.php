<?php

use App\Http\Controllers\EventController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\EventController::class, 'index']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\EventController::class, 'index'])->name('home');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('event.index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->name('event.create');
    Route::post('/events/create', [App\Http\Controllers\EventController::class, 'store'])->name('event.store');    
    Route::get('/events/{event}/edit', [App\Http\Controllers\EventController::class, 'edit'])->name('event.edit');
    Route::put('/events/{event}/edit', [App\Http\Controllers\EventController::class, 'update'])->name('event.update');
    Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy'])->name('event.destroy');
    
});

Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('event.show');

