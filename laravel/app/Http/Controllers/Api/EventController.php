<?php

namespace App\Http\Controllers\Api;

use App\Actions\Events\CreateEvent;
use App\Actions\Events\UpdateEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return $this->apiResponse->collection(EventResource::collection(Event::latest()->paginate(15)));
    }

    public function activeEvent()
    {
        return $this->apiResponse->collection(EventResource::collection(Event::whereRaw('DATE(created_at)="' . now()->format('Y-m-d') . '"')->latest()->paginate(15)));
    }

    public function show(string $id)
    {
        return $this->apiResponse->data(new EventResource(Event::findOrFail($id)))->success();
    }

    public function create(Request $request)
    {
        return $this->apiResponse->created(new EventResource(CreateEvent::dispatch($request->all())));
    }

    public function update(Request $request)
    {
        return $this->apiResponse->created(new EventResource(UpdateEvent::dispatch($request->all())));
    }

    public function delete(string $id)
    {
        return $this->apiResponse->data(EventResource::make(Event::findOrFail($id))->delete())->success();
    }
}
