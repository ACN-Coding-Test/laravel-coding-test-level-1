<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return $events;
    }

    public function activeEvents()
    {
        $now = Carbon::now()->toDateTimeString();
        $activeEvents = Event::where('startAt', '>=', $now)
        ->where('endAt', '<=', $now)->get();
        return $activeEvents;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'startAt' => 'required',
            'endAt' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'message' => 'Error',
            ], 400);
        }
        
        Event::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt
        ]);

        return response()->json([                
            'message' => 'Success'               
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $id)
    {
        $showEvent = Event::find($id);
        return $showEvent;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $id)
    {
        $validator = Validator::make($request->all(), [
            'startAt' => 'required',
            'endAt' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'message' => 'Error',
            ], 400);
        }

        $events = Event::findOrFail($id);
        $events->update($request->all());

        return response()->json([
            'message' => 'Success',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $id)
    {
        $removeEvent = Event::where('uuid',$id)->delete();

        if($removeEvent->fails())
        {
            return response()->json([
                'message' => 'Error',
            ], 400);
        }
        
        return response()->json([
            'message' => 'Success',
        ], 201);
    }
}
