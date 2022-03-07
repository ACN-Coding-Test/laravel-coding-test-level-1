<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use Carbon\Carbon;

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
        return Event::all()->isEmpty() ? 'No event' : Event::all();
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
        //
        request()->validate([
            'name' => 'required',
            'startAt' => ['required', 'date_format:Y-m-d H:i:s'],
            'endAt' => ['required', 'date_format:Y-m-d H:i:s']
        ]);
        return Event::create([
            'name' => $request->name,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $event = Event::find($id);
        return $event ? $event : 'No event' ;
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'startAt' => 'date_format:Y-m-d H:i:s',
            'endAt' => 'date_format:Y-m-d H:i:s'
        ]);        
        $success = Event::updateOrCreate(
            ['id' =>  $id],
            ['name' =>  $request->name, 'startAt' => $request->startAt, 'endAt' => $request->endAt]
        );
        return $success ? $success : 'Error';
    }

    public function patch(Request $request, $id)
    {
        $event = Event::findOrfail($id);
        if ($request->name) {
            $event->name = $request->name;
        }
     
        if ($request->startAt) {
            $event->startAt = $request->startAt;
        }
     
        if ($request->endAt) {
            $event->endAt = $request->endAt;
        }
        $event->save();
        return $event ? $event : 'Error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrfail($id);
        $success = $event->delete();
        return [ 'success' => $success ];
    }

    //Display all events that are active = current datetime is within startAt and endAt
    public function get_active_events(){
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $event = Event::where('startAt', '<', $date)->where('endAt', '>', $date)->get();
        return $event->isEmpty() ? 'No active event' : $event;
    }
}
