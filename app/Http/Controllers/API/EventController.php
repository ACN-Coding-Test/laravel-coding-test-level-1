<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Mail\EventMail;
use App\Event;
use Validator;

class EventController extends BaseController
{
      // Call internal API
      public function index()
      {
          $request = Request::create('/api/v1/events', 'GET');
          $response = Route::dispatch($request);
  
          $responseBody = json_decode($response->getContent(), true);
  
          $events = $responseBody["data"]["data"];
          
  
          $pagination = $responseBody["data"];
          
  
          return view('events.index', compact('events','pagination'));
      }


    /**
     * Show all events.
     *
     * 
     */
    public function showAllEvent()
    {
        $events = Event::get();


        return $this->sendResponse($events->toArray(), 'Events retrieved.');
    }

    /**
     * Show active events.
     *
     * @param  int  $id
     * 
     */
    public function showActiveEvent()
    {
        $dateNow = \Carbon\Carbon::now();

        

        
        $activeEvent = Event::whereDate('created_at', '<', $dateNow)->get();


        return $this->sendResponse($activeEvent->toArray(), 'Events retrieved');
    }

    /**
     * Display single Event.
     *
     * @param  int  $id
     * 
     */
    public function showEvent($id)
    {
        $event = Event::find($id);


        if (is_null($event)) {
            return $this->sendError('Event not available.');
        }


        return $this->sendResponse($event->toArray(), 'Event retrieved');
    }

    /**
     * Saved an event.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function save(Request $request)
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


        return $this->sendResponse($event->toArray(), 'Event created');
    }

    /**
     * Update event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
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


        return $this->sendResponse($event->toArray(), 'Event updated');
    }

    /**
     * Update the specified Event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
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


        return $this->sendResponse($event->toArray(), 'Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     */
    public function softDelete($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();


        return $this->sendResponse($event->toArray(), 'Event deleted');
    }

  
}
