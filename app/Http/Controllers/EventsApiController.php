<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Carbon;

class EventsApiController extends Controller
{
    public function index()
    {
        return new EventResource(Event::all());
    }

    public function store(StoreEventRequest $request)
    {
        $slug = SlugService::createSlug(Event::class, 'slug', $request->name);
        $event = Event::create($request->all() + ['slug' => $slug]);
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
        $event->update($request->all());
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
