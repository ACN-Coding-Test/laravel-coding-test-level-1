<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventMail;
use App\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show','search']);
    }

    /**
     * listing all record with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest()->paginate(5);

        return view('events.index', compact('events'))
        ->with('count', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * create record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Save record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:events'
        ]);

        $data = array(
            'name' => $request->name,
            'slug' => $request->slug
        );  


        Event::create($data);

        return redirect()->route('events.index')->with('success','Event Created Successfully');
    }

    /**
     * Display record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:events'
        ]);

        $data = array(
            'name' => $request->name,
            'slug' => $request->slug
        );

        $event->update($data);

        return redirect()->route('events.index')->with('success','Event updated successfully.');
    }

    /**
     * Delete records.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success','Event deleted successfully');
    }
    /**
     * search from events.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $events = Event::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%")
                ->get();


        return view('events.search', compact('events'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function fetchExternalAPI()
    {
        // Using guzzle to call external API
        $client = new \GuzzleHttp\Client(['verify' => false]);

        $request = $client->get('https://api.publicapis.org/entries');

        $response = $request->getBody()->getContents();
        
        $responseBody = json_decode($response, true);

        $randoms = $responseBody["entries"];
        // dd($categories);

        return view('events.external', compact('randoms'));
    }
}
