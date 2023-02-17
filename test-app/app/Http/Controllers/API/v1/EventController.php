<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the event.
     */
    public function index()
    {
        $events = Event::all();
        return json_encode($events);
    }

    /**
     * Display a listing of active event.
     */
    public function active()
    {
        $activeEvents = Event::where('startAt', '<=', Carbon::today())
                        ->where('endAt', '>=', Carbon::today())
                        ->get();
        return json_encode($activeEvents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->save();

        if($event->id) {
            return json_encode($event);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        return json_encode($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::find($id);
        if(!isset($event)) {
            return json_encode(['error' => 'event not found!']);
        }

        if($request->filled('name')) {
            $event->name = $request->name;
        }

        if($request->filled('slug')) {
            $event->slug = $request->slug;
        }

        if($request->filled('startAt')) {
            $event->startAt = $request->startAt;
        }

        if($request->filled('endAt')) {
            $event->endAt = $request->endAt;
        }
        $event->save();
        return json_encode([$event, $request]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function createOrUpdate(Request $request, string $id)
    {
        $event = Event::find($id);
        if(!isset($event)) {
            $event = new Event;
        }
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->save();

        if($event->id) {
            return json_encode($event);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        if(!isset($event)) {
            return json_encode(['error' => 'event not found!']);
        }

        if($event->delete()) {
            return json_encode(['success' => 'event is deleted!']);
        }
        else {
            return json_encode(['error' => 'event is not deleted!']);
        }
    }
}
