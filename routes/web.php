<?php

use App\Http\Controllers\DatatableController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::prefix('auth')->group(function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});

Route::get('/', function () {
    return redirect('/events');
});

Route::resource('events',EventController::class);
Route::prefix('datatables')->group(function () {
    Route::get('events', [DatatableController::class, 'events']);
});
