<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Event;

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
        $events = Event::paginate(5);
        return view("events.index", compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("events.create");
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
        $event =   Event::create(
            [
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
                'slug' => $request->slug,
                'startAt' => date("Y-m-d H:i:s", strtotime($request->start_at)),
                'endAt' => date("Y-m-d H:i:s", strtotime($request->end_at)),
                'createdAt' => now(),
                'updatedAt' => now(),
            ]
        );

        return redirect()->route("events.index");
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
        $event = Event::findOrFail($id);
        if($event->count() == 0) return redirect()->route("events.index")->withError("No Event Found!");
        
        return view("events.show", compact("event"));
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
        $event = Event::find($id);
        return view("events.edit", compact($event));
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
        //
        $event = Event::find($id);
        $event->startAt = $request->start_at? $request->start_at : $event->startAt;
        $event->endAt = $request->end_at ? $request->end_at : $event->endAt;
        $event->name = $request->name? $request->name :$event->name;
        $event->slug = $request->slug ? $request->slug :$event->slug;
        $event->updatedAt = $request->updated_at ? $request->updated_at :$event->updatedAt;
        $event->save();

        return back()->with("Event updated!");
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
        Event::destroy($id);
        return back()->with("Deleted!");
    }
}
