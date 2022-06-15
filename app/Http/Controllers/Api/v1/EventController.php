<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveEventRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveEventRequest $request)
    {
        $validated = $request->validated();
        $eventData = $this->save($validated);

        $event = Event::create($eventData);

        return response()->json($event, Response::HTTP_CREATED);
    }


    private function save($data)
    {
        $data['slug'] = Str::slug(Arr::get($data, 'slug'));
        
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    public function activeEvents()
    {   
        $currentDate = Carbon::now()->format('Y-m-d H:i:s');
        $activeEvents = Event::where('startAt','<',$currentDate)
                        ->where('endAt','>',$currentDate)                        
                        ->get();

        return response()->json($activeEvents);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveEventRequest  $request, $id)
    {
        $validated = $request->validated();
        $eventData = $this->save($validated);

        $event = Event::updateOrCreate([
                'id' => $id
                ], $eventData);

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
