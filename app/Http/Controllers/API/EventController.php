<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::latest()->get();
        return response()->json([EventResource::collection($data), 'Event displayed.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $event = Event::create([
            'event' => $request->event,
            'slug' => Str::slug($request->event),
        ]);

        return response()->json(['Event created successfully.', new EventResource($event)]);
    }

    public function showEvent($id)
    {
        $event = Event::find($id);
        if (is_null($event)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new EventResource($event)]);
    }

    public function checkEvent(Request $request, $id, Event $event)
    {
        $events = Event::find($id);
        if (is_null($events)) {
            $validator = Validator::make($request->all(), [
                'event' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $eventss = Event::create([
                'event' => $request->event,
            ]);

            return response()->json(['Event created successfully.', new EventResource($eventss)]);
        } else {
            $validator = Validator::make($request->all(), [
                'event' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $event->name = $request->event;
            $event->save();

            return response()->json(['Event updated successfully.', new EventResource($event)]);
        }
    }

    public function activeevents()
    {
        $data = Event::table('events')->select()->where();
        return response()->json([EventResource::collection($data), 'Event fetched.']);
    }

    public function updateEvent(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'event' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $event->event = $request->event;
        $event->save();

        return response()->json(['Event updated successfully.', new EventResource($event)]);
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();

        return response()->json('Event deleted successfully');
    }
}
