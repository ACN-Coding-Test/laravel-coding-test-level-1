<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use DateTime;

class Event2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retrieve all data from event table
        $events = Event::simplePaginate(3)->appends(request()->query());
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
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
        $currentDate = Carbon::now();

        //Data Validation        
        $request->validate([
            'name' => 'required',
            'startAt' => ['required'],
            'endAt' => ['required']
        ]);
        $event = new Event([
            'name' => $request->name,
            'startAt' => $request->startAt.' '.$currentDate->toTimeString(), //Adding time in format to match the database date format
            'endAt' => $request->endAt.' '.$currentDate->toTimeString() //Adding time in format to match the database date format
        ]);
        $event->save();
        return redirect('/events')->with('success', 'Event saved!');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        ////Retrieve specific data from event table
        $event = Event::find($id);

        //Remove time in datetime for datepicker output
        $event->startAt = date("Y-m-d",strtotime($event->startAt));
        $event->endAt = date("Y-m-d",strtotime($event->endAt));
        return view('events.edit', compact('event')); 
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

        $currentDate = Carbon::now();

        //Data Validation     
        $request->validate([
            'name' => 'required',
            'startAt' => ['required'],
            'endAt' => ['required']
        ]);
        //Retrieve specific data from event table
        $event = Event::find($id);
        $event->name =  $request->get('name');
        $event->startAt = $request->get('startAt').' '.$currentDate->toTimeString(); //Adding time in format to match the database date format
        $event->endAt = $request->get('endAt').' '.$currentDate->toTimeString(); //Adding time in format to match the database date format
        $event->save();

        return redirect('/events')->with('success', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $event = Event::findOrfail($id);
        $success = $event->delete();
        return redirect('/events')->with('success', 'Event  deleted!');
    }
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $events = Event::where('name', 'LIKE', "%{$search}%")->simplePaginate(3)->appends(request()->query());
    
        // Return the search view with the results compacted
        return view('events.index', compact('events'));
    }
}
