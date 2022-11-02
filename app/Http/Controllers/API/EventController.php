<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::select('id','name','slug')
            ->orderBy('start_at')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $events->count(),
            'data' => $events
        ]);
    }

    /**
     * Display a listing of the active resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active_events()
    {
        $events = Event::select('id','name','slug')
            ->whereRaw('NOW() BETWEEN start_at AND end_at')
            ->orderBy('start_at')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $events->count(),
            'data' => $events
        ]);
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
            'slug' => 'required|unique:events',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()
            ]);
        }

        $event = new Event();
        $event->fill($request->all());
        $event->save();

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $event = Event::where('id',$request->event)->first();

        if ($event) {
            return response()->json([
                'success' => true,
                'data' => $event
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $event = Event::where('id',$request->event)->first();

        if ($event) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:events,slug,'.$event->id,
                'start_at' => 'required',
                'end_at' => 'required|after:start_at'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->messages()
                ]);
            }

            $event->fill($request->all());
            $event->save();

            return response()->json([
                'success' => true,
                'data' => $event
            ]);
        } else {
            $request->merge(["id" => $request->event]);
            return $this->store($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->event)->first();

        if ($event) {
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event successfully deleted.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.'
            ]);
        }
    }
}
