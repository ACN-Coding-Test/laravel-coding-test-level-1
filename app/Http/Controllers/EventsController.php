<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function index(){
        echo "hello";
    }

    /**
     * Display events
     */
    public function getEvents()
    {
        $events = Event::where('is_deleted', 0)->get();

        return view('events', ['events' => $events]);
    }

     /**
     * Create Event
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $data = new Event();
        $data->name = $validated['name'];
        $data->slug = $validated['slug'];
        $data->save();
        
        return response()->json($data);   
    }

     /**
     * View event
     */
    public function show(Request $request) {
        $event = Event::find($request->id);
    }

     /**
     * Update Event
     */
    public function update(Request $request) {
        $event = Event::find($request->id);
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->save();
        return response()->json($event);
    }

    public function delete(Request $request) {
        $event = Event::find($request->id);
        $event->is_deleted = 1;
        $event->save();
        return response()->json($event);
    }
    
}
