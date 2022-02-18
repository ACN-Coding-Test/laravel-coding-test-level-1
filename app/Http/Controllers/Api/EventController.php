<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    // To return if request is successful
    private $successMeta = [
        'message' => 'success',
        'status_code' => 200
    ];

    // To return if request is unsuccessful
    private $failedMeta = [
        'data' => [],
        'message' => 'failed',
        'status_code' => 200
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::select('id', 'name', 'slug', 'startAt', 'endAt', 'createdAt', 'updatedAt')->get();

        // If there are no events, return failed response
        if (!$events) {
            return response()->json($this->failedMeta);
        };

        // If there are events, return successful response
        return response()->json([
            'event' => $events,
            'meta' => $this->successMeta
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeEvents()
    {
        $events = Event::where('startAt', '<=', Carbon::now())->where('endAt', '>=', Carbon::now())
            ->select('id', 'name', 'slug', 'startAt', 'endAt', 'createdAt', 'updatedAt')
            ->get();

        // If there are no events, return failed response
        if (!$events) {
            return response()->json($this->failedMeta);
        };

        // If there are events, return successful response
        return response()->json([
            'event' => $events,
            'meta' => $this->successMeta
        ]);
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
        $checkSlug = Str::slug($request->name, '-');
        // return response()->json($checkSlug);
        $checkSlugExists = Event::where('slug', $checkSlug)->first();
        if ($checkSlugExists) {
            $generateSlug = $checkSlug . '-' . rand(10, 99);
        } else {
            $generateSlug = $checkSlug;
        }

        $endAt = Carbon::parse($request->startAt)
            ->addWeek(rand(1, 52))
            ->addHour(rand(1, 24))
            ->addMinute(rand(1, 60))
            ->addSecond(rand(1, 60))
            ->format('Y-m-d H:i:s');
        // return $startAt;

        $event = array(
            'name' => $request->name,
            'slug' => $generateSlug,
            'startAt' => $request->startAt,
            'endAt' => $endAt
        );
        Event::create($event);

        // If there are no events, return failed response
        if (!$event) {
            return response()->json($this->failedMeta);
        };

        // If there are events, return successful response
        return response()->json([
            'event' => $event,
            'meta' => $this->successMeta
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)
            ->select('id', 'name', 'slug', 'startAt', 'endAt', 'createdAt', 'updatedAt')
            ->first();

        // If there are no events, return failed response
        if (!$event) {
            return response()->json($this->failedMeta);
        };

        // If there are events, return successful response
        return response()->json([
            'event' => $event,
            'meta' => $this->successMeta
        ]);
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
        // Get event data
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

        // Randomly generate end time
        $endAt = Carbon::parse($request->startAt)
            ->addWeek(rand(1, 52))
            ->addHour(rand(1, 24))
            ->addMinute(rand(1, 60))
            ->addSecond(rand(1, 60))
            ->format('Y-m-d H:i:s');

        // Update event data
        $event->name = $request->name;
        $event->slug = $generateSlug;
        $event->startAt = $request->startAt;
        $event->endAt = $endAt;
        $event->save();

        // If there are no events, return failed response
        if (!$event) {
            return response()->json($this->failedMeta);
        };

        // If there are events, return successful response
        return response()->json([
            'event' => $event,
            'meta' => $this->successMeta
        ]);
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

        // If there are no events, return failed response
        if (!$event) {
            return response()->json($this->failedMeta);
        };

        // If there are events, return successful response
        return response()->json([
            'event' => $event,
            'meta' => $this->successMeta
        ]);
    }
}
