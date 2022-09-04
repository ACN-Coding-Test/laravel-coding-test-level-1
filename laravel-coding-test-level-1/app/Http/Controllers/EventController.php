<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::all();

        return response()->json([
            'status' => true,
            'message' => 'Event Retrieved',
            'data' => $events
        ]);
    }

    public function show(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Event Found',
            'data' => $event
        ]);
    }

    public function getActive(Request $request)
    {
        $events = Event::where('startAt', '<=', Carbon::now())->where('endAt', '>=', Carbon::now())->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Event Retrieved',
            'data' => $events
        ]);
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->description = $request->description;
        $event->createdAt = now();
        $event->updatedAt = now();
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $result = $event->save();

        // $input = $request->all();
        // $result = Event::create($input);

        if($result){
            return response()->json([
                'status' => true,
                'message' => 'Event Created',
                'data' => $event
            ]);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Failed to save Event'
            ]);
        }
    }

    public function put(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Updated',
                'data' => $event
            ]);
        }
        else
        {
            $event = new Event;
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->createdAt = now();
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Created',
                'data' => $event
            ]);
        }
    }

    public function patch(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Updated',
                'data' => $event
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Event Not Found',
                'data' => null
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
    
        $event = Event::find($id);
        $event->delete();

        return response()->json([
            'status' => true,
            'message' => 'Event Deleted',
            'data' => $event
        ]);
    }

    public function store2(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->description = $request->description;
        $event->createdAt = now();
        $event->updatedAt = now();
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;

        if($event->startAt > $event->endAt || $event->endAt < $event->startAt){
            return redirect('events')->withFail('Invalid Dates!'); 
        }

        $event->save();

        return redirect('events')->withSuccess('Event Added Sucessfully!'); 
    }

    public function patch2(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;

            if($event->startAt > $event->endAt || $event->endAt < $event->startAt){
                return redirect('events')->withFail('Invalid Dates!'); 
            }

            $event->save();

            return redirect('events')->withSuccess('Event Updated Sucessfully!');
        }
        else
        {
            return redirect('events')->withFail('Failed to update Event!');
        }
    }

    public function delete2(Request $request, $id)
    {
    
        $event = Event::find($id);
        $event->delete();

        return redirect('events')->withSuccess('Event Deleted Sucessfully!');
    }

    public function search(Request $request)
    {
        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $events = Event::where('name', 'LIKE', '%'.$search_text.'%')->orderBy('createdAt')->paginate(5);
            $events->appends($request->all());
        }
        else{
            $events = Event::orderBy('createdAt', 'DESC')->paginate(5);
        }

        return view('events', compact('events'));
    }

}
