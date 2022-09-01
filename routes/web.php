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
Route::get('/sources', [App\Http\Controllers\HomeController::class, 'sources'])->name('sources');
Route::get('/details/{artical}', [App\Http\Controllers\HomeController::class, 'details'])->name('details');
Route::post('/submitComment/{artical}',[App\Http\Controllers\HomeController::class, 'comment'])->name('comment');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';