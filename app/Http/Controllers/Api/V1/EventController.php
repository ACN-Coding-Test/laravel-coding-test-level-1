<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateOrCreateEventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $events = Event::all();
        return response()->json(['ok' => true, 'data' => $events]);
    }

    public function getActiveEvents()
    {
        $events = Event::whereRaw('(now() between start_at and end_at)')->get();
        return response()->json(['ok' => true, 'data' => $events]);
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
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = new Event();
        $event->name = $request->name;
        $event->slug = Str::slug($request->slug ?? $request->name);
        $event->save();
        return response()->json(['ok' => true, 'data' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $event = Event::find($id);
        return response()->json(['ok' => true, 'data' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateOrCreateEventRequest $request, $id)
    {
        $event = Event::find($id);
        if(!$event){
            $event = new Event();
        }
        $event->name = $request->name;
        $event->slug = Str::slug($request->slug ?? $request->name);
        $event->save();
        return response()->json(['ok' => true, 'data' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrCreateEventRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateEvent(UpdateOrCreateEventRequest $request, $id): JsonResponse
    {
        $event = Event::find($id);
        $event->name = $request->name;
        $event->slug = Str::slug($request->slug ?? $request->name);
        $event->save();
        return response()->json(['ok' => true, 'data' => $event]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['ok' => true, 'message' => 'Event deleted']);
    }
}
