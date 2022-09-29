<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventCollection;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Eventapi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = Event::paginate($request->paginate ?? 20);

        return response()->json([
            'events' => $events
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required'
          ]);
          $event = new Event([
            'name' => $request->get('name'),
            'slug' => $request->get('slug')
          ]);

          $event->save();
           return response()->json([
            'events' => $event
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return response()->json([
                'error' => 'Event not found.'
            ], 200);
        }

        return response()->json([
            'events' => $event
        ], 200);
    }

    /**
     * Get active events
     *
     * @return JsonResponse
     */
    public function getActive(Request $request)
    {
        $events = Event::where('createdAt', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('updatedAt', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->get();

        return response()->json([
            'events' => EventCollection::collection($events)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function updateOrCreate(UpdateEventRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required'
          ]);
        $event = Event::updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'name' => $request->get('name'),
                'slug' => $request->get('slug')
            ]
        );

        return response()->json([
            'events' => $event
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function updateEventPartially(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return $this->sendError('Event not found.', 200);
        }

        $validated_data = $request->validated();

        $event->update($validated_data);

        return response()->json([
            'events' => $event
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return response()->json([
                'error' => 'Event not found.'
            ], 200);
        }

        $event->delete();

        return response()->json([], 200);
    }
}
