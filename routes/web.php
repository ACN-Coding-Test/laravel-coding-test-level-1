<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{EventController, HomeController, MailController};
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/events', [EventController::class,'events'])->name('events');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {    
    Route::post('/events/create',[EventController::class,'newEvent'])->name('newEvent');
    Route::post('/events/{id}/edit',[EventController::class,'updateEvent'])->name('updateEvent');
    Route::delete('/events/{id}',[EventController::class,'destroyEvent'])->name('destroyEvent');

    Route::get('/send-mail', [MailController::class,'sendEvents'])->name('sendEvents');
});