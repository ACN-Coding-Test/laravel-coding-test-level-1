<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return $events;
    }

    public function activeEvents()
    {
        $events = Event::whereDate('startAt', '<=', date('Y-m-d'))
                        ->whereDate('endAt', '>=', date('Y-m-d'))
                        ->get();
        return $events;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'startAt' => 'required',
            'endAt' => 'required'
        ]);
        
        $event = new Event();
        $event->id = Str::uuid();
        $event->name = $request->name;
        $event->slug = Str::slug($request->name);
        $event->created_at = date('Y-m-d H:i:s');
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->save();

        return response()->json(['message'=>'200', 'event' => $event]);
    }

    public function show($id)
    {
        $event = Event::find($id);
        return $event;
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'startAt' => 'required',
            'endAt' => 'required'
        ]);

        if(!Event::where('id', $id)->exists()) {
            $event = new Event();
            $event->id = Str::uuid();
        } else {
            $event = Event::find($id);
        }

        $event->name = $request->name;
        $event->slug = Str::slug($request->name);
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->save();

        return response()->json(['message'=>'200', "event"=>$event]);
    }

    public function destroy($id)
    {
        $event = Event::where("id", $id)->get();
        if(!$event->isEmpty()) {
            Event::where('id', $id )->delete();
            return response()->json(['message'=>'200']);
        } else {
            return response()->json(['message'=>'404']);
        }
    }

}
