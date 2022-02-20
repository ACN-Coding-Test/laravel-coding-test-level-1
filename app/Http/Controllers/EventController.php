<?php

namespace App\Http\Controllers;

use App\Mail\EventCreated;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

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

            $events = Event::orderBy('createdAt')->paginate(5);

            return view('events.index', compact('events'));
        } else {

            $query = $request->input('query');
            $events = Event::where('name', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%')
                ->orWhere('startAt', 'like', '%' . $query . '%')
                ->orWhere('endAt', 'like', '%' . $query . '%')
                ->orderBy('createdAt', 'desc')
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
            'name' => 'required|max:255',
            'startAt_date' => 'required',
            'startAt_time' => 'required',
            'endAt_date' => 'required',
            'endAt_time' => 'required'
        ]);

        $checkSlug = Str::slug($request->name, '-');
        $checkSlugExists = Event::where('slug', $checkSlug)->first();
        if ($checkSlugExists) {
            $generateSlug = $checkSlug . '-' . rand(10, 99);
        } else {
            $generateSlug = $checkSlug;
        }

        $event = array(
            'name' => $request->name,
            'slug' => $generateSlug,
            'startAt' => $request->startAt_date . ' ' . $request->startAt_time . ':00',
            'endAt' => $request->endAt_date . ' ' . $request->endAt_time . ':00',
        );
        Event::create($event);

        // Send new event created notification as email
        $email = 'new@event.my';
        $eventData = [
            'name' => $request->name,
            'slug' => $generateSlug,
            'startAt' => $request->startAt_date . ' ' . $request->startAt_time . ':00',
            'endAt' => $request->endAt_date . ' ' . $request->endAt_time . ':00',
        ];

        Mail::to($email)->send(new EventCreated($eventData));

        // return response()->json([
        //     'message' => 'Mail has sent.'
        // ], Response::HTTP_OK);

        return redirect()->route('events.index')->with('primary', 'Event has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)->first();

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
        $event = Event::where('id', $id)->first();

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

        // Redis recache
        Redis::del('event_' . $id);
        Redis::set('event_' . $id, $event);

        // return response()->json([
        //     'status_code' => 201,
        //     'message' => 'User updated',
        //     'data' => $event,
        // ]);

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
        Redis::del('event_' . $id);

        // return response()->json([
        //     'status_code' => 201,
        //     'message' => 'Blog deleted'
        // ]);

        return redirect()->route('events.index')->with('primary', 'Event has been deleted.');
    }

    public function cachedEventView($id)
    {
        $cachedEvent = Redis::get('event_' . $id);
        if (isset($cachedEvent)) {
            $event = json_decode($cachedEvent, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from Redis',
                'data' => $event,
            ]);
        } else {
            $event = Event::find($id);
            Redis::set('event_' . $id, $event);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $event,
            ]);
        }
    }
}
