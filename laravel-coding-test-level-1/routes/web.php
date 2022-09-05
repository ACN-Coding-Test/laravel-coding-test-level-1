<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\User;
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


Route::group(['middleware'=> 'web'], function(){
    Route::get('/events', [EventController::class, 'search']);
    Route::get('/events/{id}/edit', function ($id) {
        $event = Event::find($id);
        return view('event-edit', compact('event'));
    });
    Route::get('/events/create', function(){
        return view('event-create');
    });
    Route::get('/events/{id}', function ($id) {
        $event = Event::find($id);
        return view('event', compact('event'));
    });
    Route::patch('events/{id}', [EventController::class, 'patch2']);
    Route::post('events', [EventController::class, 'store2']);
    Route::delete('events/{id}', [EventController::class, 'delete2']);
    Route::view('register', 'register');
    Route::post('/register', [EventController::class, 'register']);

    Route::view('login', 'login');
});

Route::post('/login', [EventController::class, 'login']);

Route::get('/logout', function() {
    Session::forget('user');
     if(!Session::has('user'))
      {
         return redirect('login');
      }
    });

