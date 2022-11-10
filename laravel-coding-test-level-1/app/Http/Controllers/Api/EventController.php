<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
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

        return response()->json(['message'=>'created successfully.', 'event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
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

        $count = Event::where('name', $request->name)->count();
        if($count == 0) {
            $event = new Event();
        } else {
            $event = Event::where('name', $request->name)->first();
        }

        $event->name = $request->name;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->slug = $event->name.'-'.$event->id;
        $event->save();
        $event->slug = $event->name.'-'.$event->id;
        $event->save();

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
