<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

class EventController extends Controller
{
   
    // Return all events
    public function index() 
    {
        $getEvents = Event::all();

        return response()->json($getEvents);
    }

    // Return active events, datetime between startAt and EndAt
    public function activeEvents()
    {
        $date = date("Y-m-d H:i:s");

        $events = Event::where('status', '=', 'active')
            ->where('startAt', '<=', $date)
            ->where('endAt', '>=', $date)
            ->get();

        return response()->json($events);
    }

    // Get one event
    public function show($id)
    {
        $event = Event::find($id);
        
        return response()->json($event);
    }

    // Create an event
    public function store(Request $request)
    {
        $event              = new Event();
        $event->id          = Str::uuid();
        $event->name        = $request->name;
        $event->slug        = $request->slug;
        $event->startAt     = $request->startAt;
        $event->endAt       = $request->endAt;
        $event->createdAt   = date('Y-m-d H:i:s');
        $event->save();

        return response()->json(['message' => 'Success create event', 'code' => 200, 'event' => $event]);
    }

    // If event not exist, create new. If exist, update event
    public function update(Request $request)
    {
        $event = Event::find($request->id);
        
        if ($event){
            $update = Event::where('id', '=', $request->id)
                        ->update([
                                'name'      => $request->name,
                                'slug'      => $request->slug,
                                'startAt'   => $request->startAt, 
                                'endAt'     => $request->endAt, 
                                'updatedAt' => date('Y-m-d H:i:s')
                            ]);

            $response = array('Message'=> 'Update Event', 'Code' => 200);
        } else {
            
            $event              = new Event();
            $event->id          = Str::uuid();
            $event->name        = $request->name;
            $event->slug        = $request->slug;
            $event->startAt     = $request->startAt;
            $event->endAt       = $request->endAt;
            $event->createdAt   = date('Y-m-d H:i:s');
            $event->save();
            
            $response = array('Message'=> 'Create Event', 'Code' => 200);            
        }

        return json($response);
    }

    // Delete event
    public function delete($id)
    {
        Event::find($id)->delete();
        return response()->json(null, 204);
    }
}
