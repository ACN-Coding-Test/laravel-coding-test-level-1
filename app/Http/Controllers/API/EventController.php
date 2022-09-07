<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Event::all();

        return response()->json([EventResource::collection($data), 'Event fetched.']);
    }
    public function activeEvent()
    {
        $data = Event::where('start_at', '<=', now())
            ->where('end_at', '>=', now())
            ->get();
        return response()->json([EventResource::collection($data), 'Event fetched.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'startAt' => 'required|date',
            'endAt' => 'required|date|after:startAt'
        ]);


        $event = Event::create([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Event::class, 'slug', $request->name),
            'start_at' => $request->startAt,
            'end_at' => $request->endAt,
        ]);

        return response()->json(['Event created successfully.', new EventResource($event)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        if (is_null($event)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new EventResource($event)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
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
        //
        $method = $request->method();

        if ($method == 'PUT') {
            $this->validate($request, [
                'name' => 'required|string',
                'startAt' => 'required|date',
                'endAt' => 'required|date|after:startAt'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'sometimes|required|string',
                'startAt' => 'sometimes|required|date',
                'endAt' => 'sometimes|required|date|after:startAt'
            ]);
        }

        // $event->name = $request->name;
        // $event->start_at = $request->startAt;
        // $event->end_at = $request->endAt;
        $event->update($request->all());

        return response()->json(['Event updated successfully.', new EventResource($event)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();

        return response()->json('Event deleted successfully');
    }
}
