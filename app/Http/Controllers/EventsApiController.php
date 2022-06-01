<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsApiController extends Controller
{
    public function index()
    {
        return new EventResource(Event::all());
    }

    public function store(StoreEventRequest $request)
    {
        $event = new Event;
        $event->storeEvent($request);
        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Event $event)
    {
        return new EventResource($event);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->updateEvent($event, $request);
        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function activeEvents()
    {
        $events = Event::where('startAt', '<=', Carbon::now())
                        ->where('endAt', '>=', Carbon::now())
                        ->get();
        return new EventResource($events);
    }

}
