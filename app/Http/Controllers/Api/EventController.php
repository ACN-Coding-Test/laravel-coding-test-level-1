<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EventRequest;
use App\Http\Resources\Api\EventCollection;
use App\Http\Resources\Api\EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(){
        return new EventCollection(Event::all());
    }

    public function active(){
        return new EventCollection(Event::active()->get());
    }

    public function get($id){
        return new EventResource(Event::where('id', $id)->first());
    }

    public function store(EventRequest $request){
        try {
            $event = Event::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'slug' => $request->slug
            ]);

            return new EventResource($event);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'error' => 'An error occured'
            ], 500);
        }
    }

    public function put(EventRequest $request){
        try {
            $event = Event::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug
                ]
            );
            return new EventResource($event);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'error' => 'An error occured'
            ], 500);
        }
    }

    public function patch($id, Request $request){
        try {
            $event = Event::where('id', $id)->first();
            $event->name = $request->name;
            $event->save();
            return new EventResource($event);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }

    }

    public function delete($id){
        try {
            $event = Event::where('id', $id)->first();
            $event->delete();
            return response()->json([
                'error' => 'Event deleted'
            ], 200);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'error' => 'An error occured'
            ], 500);
        }
    }
}
