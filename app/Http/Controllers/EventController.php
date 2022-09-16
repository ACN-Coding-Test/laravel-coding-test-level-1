<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();
        return response()->json($events);
    }

    /**
     * Display a listing of the active events.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeEvents()
    {
        $events = Event::where('startAt', '<=', Carbon::now())
            ->where('endAt', '>=', Carbon::now())
            ->get();
        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug'=> 'required|unique:events',
            'startAt'=> 'required',
            'endAt'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'Error in Request Validation'
            ]);
        }

        $postData = $request->all();

        $flag = Event::create([
            'name' => $postData['name'],
            'slug' => $postData['slug'],
            'startAt'=> $postData['startAt'],
            'endAt'=> $postData['endAt']
        ]);

        if($flag)
        {
            $response = [
                'success' => true,
                'message' => 'Event created successfully.'
            ];
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Error in creating event.'
            ];
        }

        return response()->json($response);
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
     * Display the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEventById($id)
    {
        
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $event = Event::find($id);
        if(!$event) {
            return response()->json([
                'success' => false,
                'error' => 'No event found'
            ]);
        }
        $input = $request->all();
        $input['id'] = $id;
        $validator = Validator::make($input, [
            'id' => 'required|unique:events,id,'.$id,
            'name' => 'required|max:255',
            'slug'=> 'required|unique:events,slug,'.$event->id,
            'startAt'=> 'required',
            'endAt'=> 'required'
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ]);
        }
        
        $event->name = $input['name'];
        $event->slug = $input['slug'];
        $event->startAt = $input['startAt'];
        $event->endAt = $input['endAt'];
        $event->updated_at = Carbon::now();
       
        $flag = $event->save();

        if($flag)
        {
            $response = [
                'success' => true,
                'message' => 'Event updated successfully.'
            ];
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Error in creating event.'
            ];
        }

        return response()->json($response);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if(!$event) {
            return response()->json([
                'success' => false,
                'error' => 'No event found'
            ]);
        }
        $event->delete();
        return response()->json('Event deleted successfully.');
    }



    public function eventUpdate($id, Request $request)
    {
        $event = Event::find($id);
        $request->id = $id;
        $input = $request->all();
        $input['id'] = $id;
        if($event) {
            $validator = Validator::make($input, [
                'id' => 'required|unique:events,id,'.$id,
                'name' => 'required|max:255',
                'slug'=> 'required|unique:events,slug,'.$event->id,
                'startAt'=> 'required',
                'endAt'=> 'required'
            ]);
        } else {
            $validator = Validator::make($input, [
                'id' => 'required|unique:events,id,'.$id,
                'name' => 'required|max:255',
                'slug'=> 'required|unique:events,slug',
                'startAt'=> 'required',
                'endAt'=> 'required'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ]);
        }
        
        $postData = $request->all();

        if($event) {
            $event->name = $input['name'];
            $event->slug = $input['slug'];
            $event->startAt = $input['startAt'];
            $event->endAt = $input['endAt'];
            $event->updated_at = Carbon::now();
            $flag = $event->save();
        } else {
            $flag = Event::updateOrCreate($input);
        }

        if($flag)
        {
            $response = [
                'success' => true,
                'message' => 'Event updated successfully.'
            ];
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Error in creating event.'
            ];
        }

        return response()->json($response);
    }
}
