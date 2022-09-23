<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventCollection;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $events = Event::where('name', 'like', '%'.$request->input('search').'%')
                ->orWhere('slug', 'like', '%'.$request->input('search').'%')
                ->paginate($request->paginate ?? 10);
        }else{
            $events = Event::paginate($request->paginate ?? 10);
        }

        return $this->sendResponse($events, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEventRequest $request
     * @return JsonResponse
     */
    public function store(CreateEventRequest $request)
    {
        $validated_data = $request->validated();

        $event = Event::create($validated_data);

        return $this->sendResponse($event, 201);
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

        if (is_null($event)) {
            return $this->sendError('Event not found.', 200);
        }

        return $this->sendResponse($event, 200);
    }

    /**
     * Get active events
     *
     * @return JsonResponse
     */
    public function getActive(Request $request)
    {
        $events = Event::where('createdAt', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('updatedAt', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->get();

        return $this->sendResponse(EventCollection::collection($events), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function put(UpdateEventRequest $request, $id)
    {
        $validated_data = $request->validated();

        $event = Event::updateOrCreate([
            'id' => $id,
        ],
            [
                'name' => $validated_data['name'],
                'slug' => $validated_data['slug'],
            ]);

        return $this->sendResponse($event, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function patch(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return $this->sendError('Event not found.', 200);
        }

        $validated_data = $request->validated();

        $event->update($validated_data);

        return $this->sendResponse($event, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return $this->sendError('Event not found.', 200);
        }

        $event->delete();

        return $this->sendResponse([], 200);
    }
}
