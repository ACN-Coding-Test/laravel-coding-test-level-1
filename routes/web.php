<?php

use App\Http\Controllers\EventController;
use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    $events = Event::query()
    ->when(Request::input('search'), function ($query, $search) {
        $query->where('name', 'like', '%' . $search . '%')
            ->OrWhere('slug', 'like', '%' . $search . '%');
    })->paginate(10);
// dd($events);
return Inertia::render('Welcome', ['events' => $events, 'filters' => Request::only(['search'])]);
})->name('welcome');
Route::get('show/{id}', function ($id =null) {

    $event = Event::find($id);
    // dd($event);
    return Inertia::render('Event', [
        'event' => $event
    ]);
})->name('show');
Route::resource('events', EventController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
