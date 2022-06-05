<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function getAllEvents(){
        return response()->json(Event::all(), 200);
    }

    public function getActiveEvents(){
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $result = Event::where('startAt', '<', $now)
                        ->where('endAt', '>', $now)->get();

        if(is_null($result)){
            return response()->json(['message' => 'There is no active events!'], 404);
        }

        return response()->json($result, 200);
    }

    public function getEventByID($id){
        $result = Event::where('id', $id)->first();

        if(is_null($result)){
            return response()->json(['message' => 'Event not found!'], 404);
        }

        return response()->json($result, 200);
    }

    public function addEvent(Request $request){
        $uuid = Str::uuid()->toString();

        $event = Event::create([
                                'id' => $uuid,
                                'name' => $request->name,
                                'slug' => $request->slug,
                                'createdAt' => $request->createdAt,
                                'updatedAt' => $request->updatedAt,
                                'startAt' => $request->startAt,
                                'endAt' => $request->endAt,
                                ]);

        return response($event, 201);
    }

    public function updateEvent(Request $request, $id){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $uuid = Str::uuid()->toString();
        
        $event = Event::UpdateOrCreate([
            'id' => $id
         ],
         [
            'id' => $uuid,
            'name' => $request->name,
            'slug' => $request->slug,
            'updatedAt' => $now,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt,
        ]);

        return response($event, 200);
    }

    public function partialUpdateEvent(Request $request, $id){
        $event = Event::find($id);
        $now = Carbon::now()->format('Y-m-d H:i:s');

        if(is_null($event)){
            return response()->json(['message' => 'Event not found!'], 404);
        }

        if($request->name){
            $event->name = $request->name;
        }
        if($request->slug){
            $event->slug = $request->slug;
        }
        if($request->startAt){
            $event->startAt = $request->startAt;
        }
        if($request->endAt){
            $event->endAt = $request->endAt;
        }

        if($request){
            $event->updatedAt = $now;
        }
        $event->save();

        return response($event, 200);
    }

    public function deleteEvent($id){
        $event = Event::find($id);

        if(is_null($event)){
            return response()->json(['message' => 'Event not found!'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted successfully!', 200]);
    }
}
