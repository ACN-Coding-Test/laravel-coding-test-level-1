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

Route::get('/', function () {
    return view('home');
});

Route::group([
    'namespace' => 'Event',
    'prefix' => 'events',
    'as' => 'events.',
], function () {

    // Show all events
    Route::get('/', [EventController::class, 'index'])->name('index');

    Route::patch('/update/{id}', [EventController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('destroy');
});
