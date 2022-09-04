<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::all();

        return response()->json([
            'status' => true,
            'message' => 'Event Retrieved',
            'data' => $events
        ]);
    }

    public function show(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Event Found',
            'data' => $event
        ]);
    }

    public function getActive(Request $request)
    {
        $events = Event::where('startAt', '<=', Carbon::now())->where('endAt', '>=', Carbon::now())->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Event Retrieved',
            'data' => $events
        ]);
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->description = $request->description;
        $event->createdAt = now();
        $event->updatedAt = now();
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $result = $event->save();

        if($result){
            return response()->json([
                'status' => true,
                'message' => 'Event Created',
                'data' => $event
            ]);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Failed to save Event'
            ]);
        }
    }

    public function put(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Updated',
                'data' => $event
            ]);
        }
        else
        {
            $event = new Event;
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->createdAt = now();
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Created',
                'data' => $event
            ]);
        }
    }

    public function patch(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Updated',
                'data' => $event
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Event Not Found',
                'data' => null
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
    
        $event = Event::find($id);
        $event->delete();

        return response()->json([
            'status' => true,
            'message' => 'Event Deleted',
            'data' => $event
        ]);
    }

}
