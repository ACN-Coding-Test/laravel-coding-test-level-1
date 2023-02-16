<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(10);

        return $this->sendResponse('Events successfully retrieved', $events, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = Event::create($request->validated());

        if ($event) {
            return $this->sendResponse('Event successfully created', $event, 200);
        }

        return $this->sendError('Failed to create event', null, 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $this->sendResponse('Event successfully retrieved', $event, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::updateOrCreate(['id' => $id], $request->validated());

        if ($event) {
            return $this->sendResponse('Event successfully updated or created', $event, 200);
        }

        return $this->sendError('Failed to update event', null, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $res = $event->delete();

        if ($res) {
            return $this->sendResponse('Event successfully deleted', $event, 200);
        }
        return $this->sendError('Failed to delete event', null, 404);
    }

    public function activeEvents()
    {
    }
}
