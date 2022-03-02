<?php

use App\Http\Controllers\Event2Controller;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/events',[Event2Controller::class, 'index']);
// Route::get('/events/{id}',[Event2Controller::class, 'show']);
// Route::get('/events/create',[Event2Controller::class, 'create']);
// Route::get('/events/{id}/edit',[Event2Controller::class, 'edit']);
Route::resource('events', Event2Controller::class);
Route::get('/search/', [Event2Controller::class, 'search'])->name('search');