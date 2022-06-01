<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(StoreEventRequest $request)
    {
        $event = new Event;
        $event->storeEvent($request);
        return redirect()->route('events.index')->with('success','Event created successfully!');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->updateEvent($event, $request);
        return redirect()->route('events.index')->with('success','Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success','Event deleted successfully!');
    }

    public function activeEvents()
    {
        $events = Event::where('startAt', '<=', Carbon::now())
                        ->where('endAt', '>=', Carbon::now())
                        ->get();
        return new EventResource($events);
    }

}
