<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\api\baseController as BaseController;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class eventController extends BaseController
{
    public function allEvents()
    {
        $events=Event::get();
        return $this->sendResponse($events, 'Successfully Parse All Events Data.');
    }

    public function activeEvents()
    {
        $now=Carbon::now();
        $events=Event::where('startAt','<=',$now)
        ->where('endAt','>=',$now)
        ->get();
        return $this->sendResponse($events, 'Successfully Parse Active Events Data.');
    }

    public function searchEvents($id)
    {
        $events=Event::where('id',$id)
        ->get();
        return $this->sendResponse($events, 'Successfully Parse Event Data.');
    }

    public function createEvents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:events,slug',
            'startAt' => 'required|date_format:Y-m-d H:i:s',
            'endAt' => 'required|date_format:Y-m-d H:i:s',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $uuid=Str::orderedUuid();
        $eventCreate = Event::create([
            'id' => $uuid,
            'name' => $request->name,
            'slug' => $request->slug,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt,
        ]);

        $success['uuid'] =  $uuid;
        $success['event_name'] =  $eventCreate->name;
        $success['start_at'] =  $eventCreate->startAt;
        $success['end_at'] =  $eventCreate->endAt;
   
        return $this->sendResponse($success, 'Successfully Create an Event.');
    }

    public function updateEvents(Request $request,$id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:events,slug',
            'startAt' => 'required|date_format:Y-m-d H:i:s',
            'endAt' => 'required|date_format:Y-m-d H:i:s',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $eventUpdate = Event::where('id',$id)
        ->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt,
        ]);

        $success['event_name'] =  $request->name;
        $success['start_at'] =  $request->startAt;
        $success['end_at'] =  $request->endAt;
   
        return $this->sendResponse($success, 'Successfully Update an Event.');
    }

    public function putEvents(Request $request,$id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:events,slug',
            'startAt' => 'required|date_format:Y-m-d H:i:s',
            'endAt' => 'required|date_format:Y-m-d H:i:s',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $eventUpdate = Event::updateOrCreate(['id' => $id],[
            'name' => $request->name,
            'slug' => $request->slug,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt,
        ]);

        $success['event_name'] =  $request->name;
        $success['start_at'] =  $request->startAt;
        $success['end_at'] =  $request->endAt;
   
        return $this->sendResponse($success, 'Successfully Update an Event.');
    }

    public function deleteEvents($id)
    {
        $eventDelete = Event::find($id);
    	$eventDelete->delete();

        $success['id'] =  $id;
   
        return $this->sendResponse($success, 'Successfully Delete an Event.');
    }
}

