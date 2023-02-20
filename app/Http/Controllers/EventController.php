<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $events = Event::get();
        return response($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getActiveEvents(Request $request): Response
    {
        $events = Event::get();
        if($request->filled(['startAt','endAt']))
        {
            $events = $events->whereBetween('createdAt', [$request->date('startAt'), $request->date('endAt')]);
        }

        return response($events);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $event = Event::findOrFail($id);
        return response($event);
    }

    /**
     * create event
     */
    public function store(EventRequest $request): Response
    {
        $validated = $request->safe()->only('name','slug');
        Event::create($validated);
        return response([
            'message' => 'Event created.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOrCreateEvent(EventRequest $request, $id)
    {
        Event::updateOrCreate(['id' => $id, 'slug' => $request->slug],
        [
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return response()->json([
            'message' => 'Saved.'
        ]);
    }

    public function update(EventRequest $request, $id)
    {
        Event::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return response()->json([
            'message' => 'Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'message' => 'Deleted.'
        ]);
    }
}
