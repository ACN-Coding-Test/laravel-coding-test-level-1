<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Event;
use Response;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();
	
        return response()->json(['success'=> true, 'message'=>'All Event', 'data'=> $events]);
    }

    public function show($id)
    {
        $events = Event::find($id);
	
        return response()->json(['success'=> true, 'message'=>'Get one event', 'data'=> $events]);
    }

    public function active()
    {
		$date = date("Y-m-d");
		$events = Event::where('startAt', '<=', $date)->where('endAt', '>=', $date)->get();		
		
        return response()->json(['success'=> true, 'message'=>'All events that are active', 'data'=> $events]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:events',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);
        

        if($validator->fails()){
            return Response::json(['message' => 'Validation Error.', 'data' => $validator->errors()], 400);      
        }

        $events = Event::create($request->all());

        return Response::json(['message' => 'Event created.'], 201);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'slug' => 'string|unique:events',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);


        if($validator->fails()){
            return Response::json(['message' => 'Validation Error.', 'data' => $validator->errors()], 400);          
        }
   
        $events = Event::updateOrCreate([
            'id' => $id,
        ], 
        [
            'name' => $request->name,
            'slug' => $request->slug,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt
        ]);

        return Response::json(['message' => 'Event Updated.', 'data' => $events], 200);
    }

    public function patch(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'slug' => 'string|unique:events',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);


        if($validator->fails()){
            return Response::json(['message' => 'Validation Error.', 'data' => $validator->errors()], 400);         
        }
        
        $events = Event::findOrFail($id);
        $events->update($request->all());

        return Response::json(['message' => 'Event Updated.', 'data' => $events], 200);
    }


    public function destroy($id)
    {
        $events = Event::findOrFail($id);
        $events->delete();

        return Response::json(['message' => 'Event deleted.', 'data' => $events], 200);
    }


}
