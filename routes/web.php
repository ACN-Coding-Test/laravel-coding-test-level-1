<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\EventController;
use App\Models\event;    
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



Route::get('user-management', function () {

	$result=event::get();
	
			return view('pages.laravel-examples.user-management',['result'=>$result]);
		});
Route::get('/', function () {

	$result=event::get();
	
			return view('pages.laravel-examples.user-management',['result'=>$result]);
		})->name('user-management');

	Route::get('search', [EventController::class, 'search']);
	Route::get('create', [EventController::class, 'create']);
	Route::post('events/create', [EventController::class, 'eventcreate']);
	Route::get('events/{id}', [EventController::class, 'show']);
	Route::post('events/{id}/edit', [EventController::class, 'edit']);
	Route::get('delete/{id}', [EventController::class, 'delete']);

	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');