<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Resources\EventResource;
use App\Models\Event;


class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        return EventResource::collection($events);
    }

    public function activeEvents()
    {
        $events = Event::whereDate('startAt', '<=', date("Y-m-d"))
                        ->whereDate('endAt', '>=', date("Y-m-d"))->get();
        return EventResource::collection($events);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return new EventResource($event);
    }

    public function store(Request $request)
    {
        $event =   Event::create(
            [
                'id' => Str::uuid(),
                'name' => $request->name,
                'slug' => $request->slug,
                'startAt' => date("Y-m-d H:i:s", strtotime($request->start_at)),
                'endAt' => date("Y-m-d H:i:s", strtotime($request->end_at)),
                'createdAt' => now(),
                'updatedAt' => now(),
            ]
        );
        return EventResource::make($event);
    }

    public function updateOrCreate(Request $request, $id)
    {
        $request->validate(array(
            "start_at" => ['required'],
            "end_at" => ['required'],
            "name" => ['required'],
            "slug" => ['required','unique:events'],
        ));

        $params = array(
            "startAt" => $request->start_at,
            "endAt" => $request->end_at,
            "name" => $request->name,
            "slug" => $request->slug,
            "createdAt" => $request->created_at ? $request->created_at: now(),
            "updatedAt" => now(),
        );

        $event = Event::firstOrCreate([ "id" => $id],$params);
        return new EventResource($event);
    }

    public function update(Request $request, $id)
    {   
        $event = Event::find($id);
        $event->startAt = $request->start_at? $request->start_at : $event->startAt;
        $event->endAt = $request->end_at ? $request->end_at : $event->endAt;
        $event->name = $request->name? $request->name :$event->name;
        $event->slug = $request->slug ? $request->slug :$event->slug;
        $event->updatedAt = $request->updated_at ? $request->updated_at :$event->updatedAt;
        $event->save();

        return new EventResource($event);
    }

    public function destroy($id)
    {
        Event::destroy($id);

        return ["success" => true, "message" => "Successfully Deleted"];
    }
}
