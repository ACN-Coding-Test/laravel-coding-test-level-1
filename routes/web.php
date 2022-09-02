<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/events/show/{event}', [App\Http\Controllers\EventController::class, 'show']);

Route::middleware(['auth'])->group(function () {
        
    Route::get('/events/create',[App\Http\Controllers\EventController::class, 'create']);
    Route::post('/events/store', [App\Http\Controllers\EventController::class, 'store']);
    Route::put('/events/update/{event}', [App\Http\Controllers\EventController::class, 'update']);
    Route::get('/events/edit/{event}', [App\Http\Controllers\EventController::class, 'edit']);
    Route::delete('/events/delete/{event}', [App\Http\Controllers\EventController::class, 'delete']);
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';