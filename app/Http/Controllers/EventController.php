<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Services\EventService;

class EventController extends Controller
{
    use ControllerTrait;

    public function __construct()
    {
        $this->middleware('auth');
        Redis::connection();
    }

    public function events()
    {
        $es = new EventService();
        $events = $es->getEvents();

        $data = [];
        $data['events'] = $events;

        return view('event.index', $data);
    }

    public function newEvent(Request $request)
    {
        $es = new EventService();
        $es->createEvent($request);
        return Redirect::back()->withSuccessMessage("Event successfully created");
    }

    public function updateEvent(Request $request)
    {
        $es = new EventService();
        $es->updateEventPartially($request);
        return Redirect::back()->withSuccessMessage("Event successfully updated");
    }

    public function destroyEvent($id)
    {
        $es = new EventService();
        $es->deleteEvent($id);
        return Redirect::back()->withSuccessMessage("Event successfully deleted");
    }

    public function getEvents()
    {
        $es = new EventService();
        $events = $es->getEvents();
        return $this->sendResponseApi('Events successfully retrieved', 1, $events);
    }

    public function getEventsByStatus()
    {
        $es = new EventService();
        $event = $es->getEventsByStatus();
        return $this->sendResponseApi('Events successfully retrieved', 1, $event);
    }

    public function getEventById($id)
    {
        $es = new EventService();
        $event = $es->getEventById($id);
        return $this->sendResponseApi('Event successfully retrieved', 1, $event);
    }

    public function createEvent(Request $request)
    {
        $es = new EventService();
        $event = $es->createEvent($request);
        return $this->sendResponseApi('Event successfully created', 1, $event);
    }

    public function updateOrCreate(Request $request)
    {
        $es = new EventService();
        $event = $es->updateOrCreate($request);
        return $this->sendResponseApi('Event successfully updated or created', 1, $event);
    }

    public function updateEventPartially(Request $request)
    {
        $es = new EventService();
        $event = $es->updateEventPartially($request);
        return $this->sendResponseApi('Event successfully updated', 1, $event);
    }

    public function deleteEvent($id)
    {
        $es = new EventService();
        $event = $es->deleteEvent($id);
        return $this->sendResponseApi('Event successfully deleted', 1, $event);
    }
}