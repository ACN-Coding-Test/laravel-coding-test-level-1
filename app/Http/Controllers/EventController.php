<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Services\{EventService,MailService};
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class EventController extends Controller
{
    use ControllerTrait;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success_message')) {
                Alert::success('Success!', session('success_message'));
            }
    
            if (session('error_message')) {
                Alert::error('Error!', session('error_message'));
            }
    
            return $next($request);
        });

        Redis::connection();
    }

    public function events()
    {
        $es = new EventService();
        $events = $es->getEvents();

        $weather = $es->getWeatherByStateAndCountry();

        $weatherForecast                    = [];
        $weatherDetails                     = [];
        $weatherDetails['resolvedAddress']  = $weather->resolvedAddress;
        $weatherDetails['timezone']         = $weather->timezone;

        // forecast for 3 days
        for ($i = 0; $i < 3; $i++)
        {
            $weatherForecast['datetime']             = date('d-m-Y', strtotime($weather->days[$i]->datetime));
            $weatherForecast['conditions']           = $weather->days[$i]->conditions;
            $weatherForecast['description']          = $weather->days[$i]->description;
            $weatherForecast['temperature']          = round((($weather->days[$i]->temp - 32) * 5) / 9, 1);
            $weatherForecast['sunrise']              = date('h:i A', strtotime($weather->days[$i]->sunrise));
            $weatherForecast['sunset']               = date('h:i A', strtotime($weather->days[$i]->sunset));

            $weatherDetails['days'][] = $weatherForecast;
        }

        $data = [];
        $data['events'] = $events ?? [];
        $data['weathers'] = $weatherDetails;

        return view('event.index', $data);
    }

    public function newEvent(Request $request)
    {
        try {
            $es = new EventService();
            $event = $es->createEvent($request);

            $ms = new MailService();
            $mail = $ms->sendEvents($event);
            if ($mail) toast('Event email has been sent!','success');

            return Redirect::back()->withSuccessMessage("Event successfully created");
        } catch (Exception $e) {
            return Redirect::back()->withErrorMessage($e->getMessage())->withInput();
        }
    }

    public function updateEvent(Request $request)
    {
        try {
            $es = new EventService();
            $es->updateEventPartially($request);

            return Redirect::back()->withSuccessMessage("Event successfully updated");
        } catch (Exception $e) {
            return Redirect::back()->withErrorMessage($e->getMessage())->withInput();
        }
    }

    public function destroyEvent($id)
    {
        try {
            $es = new EventService();
            $es->deleteEvent($id);

            return Redirect::back()->withSuccessMessage("Event successfully deleted");
        } catch (Exception $e) {
            return Redirect::back()->withErrorMessage($e->getMessage())->withInput();
        }
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