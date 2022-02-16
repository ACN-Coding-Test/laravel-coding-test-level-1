<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Event;
use Validator;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllEvent()
    {
        $events = Event::all();


        return $this->sendResponse($events->toArray(), 'Events retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showActiveEvent()
    {
        $dateNow = \Carbon\Carbon::now();

        
        $activeEvent = Event::whereDate('created_at', '<', $dateNow)->get();


        return $this->sendResponse($activeEvent->toArray(), 'Events retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOneEvent($id)
    {
        $event = Event::find($id);


        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }


        return $this->sendResponse($event->toArray(), 'Event retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:events'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $event = Event::create($input);


        return $this->sendResponse($event->toArray(), 'Event created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function put(Request $request, $id)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:events'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $event = Event::updateOrCreate([
            'id' => $id,
        ], 
        [
            'name' => $request->name,
            'slug' => $request->slug,
        ]);


        return $this->sendResponse($event->toArray(), 'Event updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patch(Request $request, $id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }

        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:events'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $event->name = $input['name'];
        $event->slug = $input['slug'];
        $event->save();


        return $this->sendResponse($event->toArray(), 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();


        return $this->sendResponse($event->toArray(), 'Event deleted successfully.');
    }
}
