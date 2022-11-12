<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Cache::rememberForever('events', function () {
            return Event::orderBy('created_at', 'desc')->get();
        });
        return $events;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'startAt' => 'required',
            'endAt' => 'required'
        ]);
        
        $event = new Event();
        $event->name = $request->name;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->slug = $request->name.'-'.$event->id;
        $event->save();
        $event->slug = $event->name.'-'.$event->id;
        $event->save();

        Cache::forget('events');
        return response()->json(['message'=>'created successfully.', 'event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Cache::rememberForever($id, function () use($id) {
            return Event::find($id);
        });

        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required',
            'startAt' => 'required',
            'endAt' => 'required'
        ]);

        if(!Event::where('name', $request->name)->exists()) {
            $event = new Event();
        } else {
            $event = Event::where('name', $request->name)->first();
            Cache::forget($event->id);
        }

        $event->name = $request->name;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->slug = $event->name.'-'.$event->id;
        $event->save();
        $event->slug = $event->name.'-'.$event->id;
        $event->save();

        Cache::forget('events');

        return response()->json(['message'=>"success", "event"=>$event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Cache::forget($event->id);
        Cache::forget('events');
        $event->delete();

        return response()->json(["message"=>"deleted successfully"]);
    }

    public function activeEvents()
    {
        $events = Event::whereDate('startAt', '<=', date('Y-m-d'))
                        ->whereDate('endAt', '>=', date('Y-m-d'))
                        ->get();
        return $events;
    }
}
