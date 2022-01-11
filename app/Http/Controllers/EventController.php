<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Notifications\EventCreated;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$events = Event::all();
        //return view('events.index', compact('events'));

        return view('events.index', [
            'events' => DB::table('events')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        /* $event = new Event();
        $event->name = $request->name;
        $event->slug = $request->slug;

        $event->save(); */

        Event::create($request->all());

        $user = Auth::user();

        // Send email notification 
        //$user->notify(new EventCreated);

        return redirect('/events')->with('success', 'Event created successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request)
    {
        return Event::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Event $event, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $event->name = $request->name;
        $event->slug = $request->slug;

        $event->save();

        return redirect('/events')->with('success', 'Event updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apiUpdate(Request $request, $id)
    {
        //$event = Event::findOrFail($id);
        $event = Event::find($id);

        if ($event)
        {
            $event->update($request->all());
        }
        else
        {
            $event = Event::create($request->all());
        }

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Event::destroy($id);

        return redirect('/events')->with('success', 'Event deleted successfully!');
    }

    public function apiDelete($id)
    {
        $result = Event::destroy($id);

        if ($result == 0)
        {
            http_response_code(404);
        }
        else
        {
            return $result;
        }
    }

    public function remote()
    {
        return view('events.remote');
    }
}
