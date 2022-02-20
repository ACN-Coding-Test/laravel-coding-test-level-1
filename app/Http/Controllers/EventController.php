<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->query)) {

            $events = Event::orderBy('startAt')->paginate(5);

            return view('events.index', compact('events'));
        } else {

            $query = $request->input('query');
            $events = Event::where('name', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%')
                ->orWhere('startAt', 'like', '%' . $query . '%')
                ->orWhere('endAt', 'like', '%' . $query . '%')
                // ->get()
                ->paginate(5);

            return view('events.index', compact('events'));
        }
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
        //
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
        $event = Event::where('id', $id)
            ->select('id', 'name', 'slug', 'startAt', 'endAt', 'createdAt', 'updatedAt')
            ->first();

        // Check slug already existed or not 
        $getSlug = $request->slug;
        if ($getSlug == $event->slug) {
            $generateSlug = $getSlug;
        } else {
            $checkSlug = Str::slug($request->name, '-');
            $checkSlugExists = Event::where('slug', $checkSlug)->first();
            if ($checkSlugExists) {
                $generateSlug = $checkSlug . '-' . rand(10, 99);
            } else {
                $generateSlug = $checkSlug;
            }
        }

        $data = array(
            'name' => $request->name,
            'slug' => $generateSlug,
            'startAt' => $request->startAt_date . ' ' . $request->startAt_time . ':00',
            'endAt' => $request->endAt_date . ' ' . $request->endAt_time . ':00',
        );

        $event->update($data);

        return redirect()->route('events.index')->with('primary', 'Event has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('id', $id)
            ->delete();

        return redirect()->route('events.index')->with('primary', 'Event has been deleted.');
    }
}
