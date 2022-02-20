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

Route::resource('events', EventController::class, [
    'names' => [
        'index' => 'events',
        'store' => 'events.store',
        'create' => 'events.create',
        'show' => 'events.show',
        // 'destroy' => 'events.destroy'
        // etc...
    ]
]);

Route::get('events/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');

Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');

Route::post('events/{id}/update', [EventController::class, 'update'])->name('events.update');
