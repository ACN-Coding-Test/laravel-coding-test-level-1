<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Models\{
    Event,
    User
};
use App\Mail\EventCreated;
use Mail;

class EventController extends Controller
{
    protected $redName;

    public function __construct()
    {
        $this->middleware('auth');
        $this->redName = 'ev:';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = Event::filter($request)->paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'startDate'    => 'required|date',
            'endDate'      => 'required|date|after_or_equal:startDate',
            'startTime'    => 'required|date_format:H:i:s',
            'endTime'      => 'required|date_format:H:i:s|after_or_equal:startTime',
        ], [
            'endTime.after_or_equal' => 'End Time must be after or equal the Start Time'
        ]);

        $event = new Event;
        $event->name = $request->name;
        $event->startAt = $request->startDate.' '.$request->startTime;
        $event->endAt = $request->endDate.' '.$request->endTime;
        $event->save();

        Redis::set($this->redName . $id, $event);

        //Send mail to all users
        $users = User::pluck('email')->toArray();
        Mail::to($users)->send(new EventCreated($event));

        return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cachedData = Redis::get($this->redName . $id);
        if(isset($cachedData)) {
          $event = json_decode($cachedData, FALSE);
        }else {
          $event = Event::findOrFail($id);
          Redis::set($this->redName . $id, $event);
        }

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cachedData = Redis::get($this->redName . $id);
        if(isset($cachedData)) {
          $event = json_decode($cachedData, FALSE);
        }else {
          $event = Event::findOrFail($id);
          Redis::set($this->redName . $id, $event);
        }

        return view('events.edit', compact('event'));
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
        $request->validate([
            'name' => 'required',
            'startDate'    => 'required|date',
            'endDate'      => 'required|date|after_or_equal:startDate',
            'startTime'    => 'required|date_format:H:i:s',
            'endTime'      => 'required|date_format:H:i:s|after_or_equal:startTime',
        ], [
            'endTime.after_or_equal' => 'End Time must be after or equal the Start Time'
        ]);

        Redis::del($this->redName . $id);

        $event = Event::findOrFail($id);
        $event->name = $request->name;
        $event->startAt = $request->startDate.' '.$request->startTime;
        $event->endAt = $request->endDate.' '.$request->endTime;
        $event->save();

        Redis::set($this->redName . $id, $event);

        return redirect()->route('events.show', ['event' => $event]);
    }
}
