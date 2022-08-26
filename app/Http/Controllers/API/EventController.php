<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Validator;

class EventController extends Controller
{
    //
    public function index()
    {
        $Events = Event::all();
        return response()->json([
        "success" => true,
        "message" => "Event List",
        "data" => $Events
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required',
        'slug' => 'required'
        ]);

        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }

        $Vendor = Event::create($input);
        return response()->json([
        "success" => true,
        "message" => "Event created successfully.",
        "data" => $Vendor
        ]);
    } 

    public function show($id)
    {
        $Event = Event::find($id);
        if (is_null($Event)) {
        return $this->sendError('Event not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Event retrieved successfully.",
        "data" => $Event
        ]);
    }


    public function update(Request $request, Event $Event)
    {
        $input = $request->all();
        

        if($request->isMethod('PUT'))
        {
            $validator = Validator::make($input, [
                'name' => 'required',
                'slug' => 'required'
                ]);
                
                if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
                }

            $Event->name = $input['name'];
            $Event->slug = $input['slug'];
            $Event->save();
            return response()->json([
            "success" => true,
            "message" => "Event updated successfully.",
            "data" => $Event
            ]);
        }
        else
        {
            //$Event = $request->input();
            $validator = Validator::make($input, [
                'name' => 'required'
                ]);
                
                if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
                }
            
            $data = array('name'=>$input['name']);

            Event::where('id', $Event['id'])->update($data);
            return response()->json([
                "success" => true,
                "message" => "Event name updated successfully.",
                "data" => $Event
                ]);
        }
        
        
        
    }

    public function destroy(Event $Event)
    {
        $Event->delete();
        return response()->json([
        "success" => true,
        "message" => "Event deleted successfully.",
        "data" => $Event
    ]);
    }

}
