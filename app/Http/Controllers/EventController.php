<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Event;
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
        return Event::all();
    }

    /**
     * Get the active events = current datetime is within startAt and endAt
     *
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Event::firstOrFail($id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);
        //generate UUID
        $uuid = Str::orderedUuid()->toString();

        $event = Event::create([
            'id' => $uuid,
            'name' => $fields['name'],
            'slug' => Str::slug($fields['name']),
            'start_at' => $fields['start_at'],
            'end_at' => $fields['end_at'],
        ]);

        $response = [
            'event' => $event,
            'message' => 'event '.$fields['name'].' successfully created!',
        ];

        return response($response, 201);
    }


    /**
     * To create or update data
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdate($id)
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
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        $event = Event::findOrFail($id);

        $event->update([
            'name' => $fields['name'],
            'slug' => Str::slug($fields['name']),
            'start_at' => $fields['start_at'],
            'end_at' => $fields['end_at'],
        ]);

        $response = [
            'event' => $event,
            'message' => 'event '.$fields['name'].' succesfully updated!',
        ];

                return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        $response = [
            'event' => $event,
            'message' => 'event succesfully deleted',
        ];

        return response($response, 201);
    }
}
