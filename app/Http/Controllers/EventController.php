<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActiveEventRequest;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);

        return view('events.index', ['events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $event = new Event();
        $event->id = Str::uuid();
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->start_at = Carbon::parse($request->start_at)->toDateTimeString();
        $event->end_at = Carbon::parse($request->end_at)->toDateTimeString();
        $event->save();

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        Event::updateOrCreate(['id' => $id], $request->validated());

        $events = Event::orderBy('created_at', 'desc')->paginate(10);

        return redirect()->route('event.index');
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

    public function activeEvents(ActiveEventRequest $request)
    {
        $validated = $request->validated();

        if (!$validated) {
            return $this->sendError('Failed to retrieve active events', null, 404);
        }
        $startAt = Carbon::parse($validated['start_at']);
        $endAt = Carbon::parse($validated['end_at']);

        if ($startAt > $endAt) {

            return $this->sendError('Start At must be earlier than End At', null, 404);
        }

        $events = Event::whereDate('start_at', '>=', $startAt)->whereDate('end_at', '<=', $endAt)->get();

        if ($events->isNotEmpty()) {
            return $this->sendResponse('Active events successfully retrieve', $events, 200);
        }
        return $this->sendError('Active events not found', null, 202);
    }
}
