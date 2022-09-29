<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;

class EventService
{
	public function getEvents()
	{
		$event = Event::get();
        return $event;
	}

    public function getEventsByStatus()
	{
        $startAt = Carbon::now()->startOfDay();
        $endAt   = Carbon::now()->endOfDay();

        $event = Event::whereBetween('created_at', [$startAt, $endAt])->get();
        return $event;
	}

    public function getEventById($id) : Event
    {
        $event = Event::where('id', $id)->firstOrFail();
        return $event;
    }

    public function createEvent($request) : Event
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:event',
        ]);

        $event = Event::create([
            'name' => $validated['name'],
            'slug' => $validated['slug']
        ]);

        return $event;
    }

    public function updateOrCreate($request): Event
    {
        $event = Event::updateOrCreate(
            ['id' => $request['id']],
            ['name' => $request['name'],'slug' => $request['slug']]
        );

        return $event;
    }

    public function updateEventPartially($request) : Event
    {
        $event = Event::findOrFail($request['id']);

        if ($request->has('name')) {
            $event->name = $request->name;
        }

        if ($request->has('slug')) {
            $event->slug = $request->slug;
        }
        
        $event->save();

        return $event;
    }

    public function deleteEvent($id) : Event
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return $event;
    }
}