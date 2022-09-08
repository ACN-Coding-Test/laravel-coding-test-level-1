<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Event;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

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
        // $events = Event::paginate(4);
        $events = Event::query();
        if (request('term')) {
            $events->where('name', 'Like', '%' . request('term') . '%');
        }
        $events = $events->paginate(5);

        return view('event/index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('event/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
            'startAt' => 'required|date|before:endAt',
            'endAt' => 'required|date|after:startAt'
        ]);

        $event = new Event();

        $event->name = $request->name;
        $event->start_at = $request->startAt;
        $event->slug = SlugService::createSlug(Event::class, 'slug', $request->name);
        $event->end_at = $request->endAt;
        $event->save();

        $details = ['email' => 'recipient@example.com'];
        SendEmail::dispatch($details);

        return redirect(route('event.index'))->with('status', 'Event Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        return view('event/show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        return view('event/edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
            'startAt' => 'required|date|before:endAt',
            'endAt' => 'required|date|after:startAt'
        ]);

        $event->update(
            [
                'name' => $request->name,
                'slug' => SlugService::createSlug(Event::class, 'slug', $request->name),
                'start_at' => date('Y-m-d H:i', strtotime($request->startAt)),
                'end_at' => date('Y-m-d H:i', strtotime($request->endAt)),
            ]
        );
        return redirect(route('event.index'))->with('status', 'Event Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        return redirect(route('event.index'))->with('status', 'Event Successfully Deleted');
    }
}
