<?php

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

Route::get('/events', function() {
    // Show all events in a table
    $events = Event::all();
    return view('events.index', ['events' => $events]);
});

Route::get('/events/{id}', function($id) {
    // Show individual event
    $event = Event::find($id);
    return view('events.show', ['event' => $event]);
});

Route::get('/events/create', function() {
    // Create an event
    return view('events.create');
});


Route::put('/events/{id}/edit', function(Request $request, $id) {
    // Update the event
    $event = Event::find($id);
    return view('events.edit', ['event' => $event]);
});
