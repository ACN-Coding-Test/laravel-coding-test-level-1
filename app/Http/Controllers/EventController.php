<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->OrWhere('slug', 'like', '%' . $search . '%');
            })->paginate(10);
        // dd($events);
        return Inertia::render('Event/Event', ['events' => $events, 'filters' => Request::only(['search'])]);
        // return Inertia::render('Users/Index',
        // [
        //     'users' => Event::query()
        //         ->when(Request::input('search'),function($query, $search) {
        //             $query->where('name','like','%'.$search.'%')
        //             ->OrWhere('email','like','%'.$search.'%');
        //         })->paginate(6)
        //         ->withQueryString(),
        //         'filters' => Request::only(['search'])
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Event/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'slug' => ['required'],
        ])->validate();

        Event::create($request->all());

        return redirect()->route('events.index');
    }
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $event = Event::find($id);
        // dd($event);
        return Inertia::render('Event/Show', [
            'event' => $event
        ]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(Event $event)
    {
        return Inertia::render('Event/Edit', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'slug' => ['required'],
        ])->validate();

        Event::find($id)->update($request->all());
        return redirect()->route('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->route('events.index');
    }
}
