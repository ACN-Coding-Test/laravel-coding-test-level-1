<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Event;
use Illuminate\Support\Carbon;


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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'startAt' => 'required|date',
            'endAt' => 'required|date',

        ]);

        $slug=Str::of($request->name)->slug('-');
        $is_exist=Event::where('slug', '=', $slug)->count();
        if ($is_exist>0) {
            return response()->json(['error'=>'event already exist']);
        }
        $event=Event::create(array(
            'name'=>$request->name,
            'slug'=>$slug,
            'startAt'=>$request->startAt,
            'endAt'=>$request->endAt,

        ));
        return response()->json(['event'=>$event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $events=Event::find($id);
        return response()->json(['event' => $events]);
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
    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'name' => 'required',
            'startAt' => 'required|date',
            'endAt' => 'required|date',

        ]);
        $event = Event::findOrFail($id);
        $slug=Str::of($request->name)->slug('-');
        $is_exist=Event::where('slug', '=', $slug)->count();
        if ($is_exist>0) {
            return response()->json(['error'=>'event slug already exist']);
        }
        $event->update(array(
            'name'=>$request->name,
            'slug'=>$slug,
            'startAt'=>$request->startAt,
            'endAt'=>$request->endAt,

        ));
        return response()->json(['event'=>$event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Event::findOrFail($id)->delete();

      return response()->json(null, 204);
    }

   
    public function getActiveList()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        // $endAt = Carbon::now()->subDays(1)->format('Y-m-d');
        $events=Event::where('endAt', '<=', $current_date)
        ->when($current_date, function ($query, $current_date) {
            return $query->orWhere('startAt','>=', $current_date);
        })->get();
        return response()->json($events);
    }
}
