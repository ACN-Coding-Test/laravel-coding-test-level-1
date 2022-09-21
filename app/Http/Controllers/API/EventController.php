<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventResource;

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

        return EventResource::collection($events);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActiveEvents()
    {
        $datetime = date('Y-m-d H:i:s');
        $events = Event::where('createdAt', '<=', $datetime)->where('updatedAt', '>=', $datetime)->get();

        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique',
            'createdAt' => 'required',
            'updatedAt' => 'required',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'createdAt' => $request->createdAt,
            'updatedAt' => $request->updatedAt,
        ]);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id); 

        if(!$event && $request->method() === "PUT") {
            // create new event 
            $event = Event::firstOrNew($request->all());
            $event->save();
        }
        else {
            if ($request->has('name')) { $event->name = $request->name; }
            if ($request->has('slug')) { $event->slug = $request->slug; }
            if ($request->has('createdAt')) { $event->createdAt = $request->createdAt; }
            if ($request->has('updatedAt')) { $event->updatedAt = $request->updatedAt; }

            $event->save();
        }

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Event::where('id', $id)->delete();
        Event::destroy($id);

        return response()->json(null, 204);
    }
}
