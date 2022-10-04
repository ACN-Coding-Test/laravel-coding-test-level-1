<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Models\Event;
use Carbon\Carbon;

class EventService
{
    public function getWeatherByStateAndCountry()
    {
        $apiKey     = "LZ4W466CYHEW3KQVY7PZKH56E";
        $state      = "Dengkil";
        $country    = "MY";

        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' . $state . ',' . $country .'?key='. $apiKey .'');
        $response = $request->getBody()->getContents();

        return json_decode($response);
    }

	public function getEvents()
	{
        $cachedEvent = Redis::get('events_');

        if(!empty($cachedEvent)) {
            $events = json_decode($cachedEvent, TRUE);
        } else {
            $events = Event::get();
            Redis::set('events_', $events);
        }

        return $events;
	}

    public function getEventsByStatus()
	{
        $startAt = Carbon::now()->startOfDay();
        $endAt   = Carbon::now()->endOfDay();

        $cachedEvents = Redis::get('events_');
    
        if(!empty($cachedEvents)) {
            $events = json_decode($cachedEvents, TRUE);
        } else {
            $events = Event::whereBetween('created_at', [$startAt, $endAt])->get();
            Redis::set('events_', $events);
        }

        return $events;
	}

    public function getEventById($id) : Event
    {
        $cachedEvent = Redis::get('event_' . $id);
    
        if(!empty($cachedEvent)) {
            $event = json_decode($cachedEvent, TRUE);
        } else {
            $event = Event::where('id', $id)->firstOrFail();
            Redis::set('event_' . $id, $event);
        }

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
            'slug' => Str::slug($validated['slug'], '-')
        ]);

        Redis::del('events_');

        return $event;
    }

    public function updateOrCreate($request): Event
    {
        $event = Event::updateOrCreate(
            ['id' => $request['id']],
            ['name' => $request['name'],'slug' => $request['slug']]
        );

        if($event) {
            Redis::del('events_');
      
            $event = Event::find($request['id']);
            // Set a new key with the event id
            Redis::set('event_' . $request['id'], $event);
        }

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

        if($event) {
            Redis::del('events_');
      
            $event = Event::find($request['id']);
            // Set a new key with the event id
            Redis::set('event_' . $request['id'], $event);
        }

        return $event;
    }

    public function deleteEvent($id) : Event
    {
        $event = Event::findOrFail($id);
        $event->delete();
        Redis::del('events_');

        return $event;
    }
}