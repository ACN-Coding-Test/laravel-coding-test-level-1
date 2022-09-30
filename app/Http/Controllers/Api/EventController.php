<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Event;
use Validator;
use DB;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::filter()->get();

        return $this->successResponse($events);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeEvents()
    {
        $events = Event::filter()->whereBetween(DB::RAW('NOW()'),[DB::RAW('startAt'), DB::RAW('endAt')])->get();

        return $this->successResponse($events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'startAt' => 'required|date_format:Y-m-d H:i:s',
            'endAt' => 'required|date_format:Y-m-d H:i:s',
        ]);
        
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Validation error');
        }

        $event = new Event;
        $event->name = $request->name;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->save();

        return $this->successResponse($event, 'Event successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        if($event) {
            return $this->successResponse($event);
        }else {
            return $this->errorResponse(null, 'Event does not exist', 404);
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'startAt' => 'required|date_format:Y-m-d H:i:s',
            'endAt' => 'required|date_format:Y-m-d H:i:s',
        ]);
        
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Validation error');
        }

        $event = Event::find($id);
        $event->name = $request->name;
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->save();

        return $this->successResponse($event, 'Event successfully update');
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
        if($event) {
            $event->delete();
            return $this->successResponse(null, 'Event successfully deleted');
        }else {
            return $this->errorResponse(null, 'Event does not exist', 404);
        }
    }
}
