<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\EventCreated;
use Illuminate\Support\Facades\Mail;
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
        //
        $events = Event::paginate(5);
        return view("events.index", compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("events.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            array(
                "start_date" => ['required'],
                "end_date" => ['required'],
                "name" => ['required'],
                "slug" => ['required','unique:events'],
            )
        );
        //
        $event =   Event::create(
            [
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
                'slug' => $request->slug,
                'startAt' => date("Y-m-d H:i:s", strtotime($request->start_date)),
                'endAt' => date("Y-m-d H:i:s", strtotime($request->end_date)),
                'createdAt' => now(),
                'updatedAt' => now(),
            ]
        );
        Mail::to($request->user())->send(new EventCreated($event));
        return redirect()->route("events.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $event = Event::findOrFail($id);
        if($event->count() == 0) return redirect()->route("events.index")->withError("No Event Found!");
        
        return view("events.show", compact("event"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $event = Event::find($id);
        return view("events.edit", compact("event"));
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
        //
        $request->validate(
            array(
                "start_date" => ['required'],
                "end_date" => ['required'],
                "name" => ['required'],
                "slug" => ['required','unique:events'],
            )
        );
       
        $event = Event::find($id);
        $event->startAt = $request->start_date? $request->start_date : $event->startAt;
        $event->endAt = $request->end_date ? $request->end_date : $event->endAt;
        $event->name = $request->name? $request->name :$event->name;
        $event->slug = $request->slug ? $request->slug :$event->slug;
        $event->updatedAt = $request->updated_at ? $request->updated_at :$event->updatedAt;
        $event->save();
        
       

        return back()->with("Event updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Event::destroy($id);
        return back()->with("Deleted!");
    }

    /**
     * Fetch data using the GuzzleHTTP
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apiFetch()
    {
        // I can't test due to php single thread error. 
        $url = "http://127.0.0.1:8000/api/v1/events"; //change url
        $client = new Client();
        $response = $client->get($url);
        if($response && $response->getBody()) {
            dd($response->getBody());
        }

    }
}
