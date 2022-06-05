<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\EventController;

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


Route::get('/events',  [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');


// Route::get('/events/create', function(){
//     return view('events/create-edit');
// });
