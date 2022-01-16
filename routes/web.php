<?php
use Illuminate\Http\Request;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',                     [EventController::class, 'event_list_web']);
Route::get('/events',               [EventController::class, 'event_list_web'])->name('event_list_web');
Route::get('/events/create',        [EventController::class, 'event_create_web'])->name('event_create_web');
Route::get('/events/{id}',          [EventController::class, 'event_show_web'])->name('event_show_web');
Route::post('/event_name_exist',    [EventController::class, 'event_name_exist'])->name('event_name_exist');
Route::get('events/{id}/edit',      [EventController::class, 'event_edit_web'])->name('event_edit_web');
Route::put('events/{id}/edit',      [EventController::class, 'update_event'])->name('update_event');
Route::post('events/event_store',   [EventController::class, 'create_event'])->name('event_store');
Route::post('events/delete',        [EventController::class, 'delete_event_web'])->name('delete_event_web');
Route::post('events/search',        [EventController::class, 'search_event_web'])->name('search_event_web');

Route::get('/cache',                [EventController::class, 'event_list_cache'])->name('event_list_cache');
Route::get('/remote',               [EventController::class, 'event_list_remote'])->name('event_list_remote');

