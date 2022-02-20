<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\BaseApiController;

class EventApiController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $events = Event::get();
            return EventResource::collection($events);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
        }
    }

    public function activeEvent()
    {

        try {
            $now = Carbon::now();
            $events = Event::where('start_at', '<=', $now)
                ->where('end_at', '>=', $now)
                ->get();

            return EventResource::collection($events);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
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
        try {
            $rules = array(
                "name" => "required",
                "start_at" => "required",
                "end_at" => "required"
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $event = new Event();
                $event->name = $request->name;
                $event->slug = Str::slug($request->name, '-');
                $event->start_at = $request->start_at;
                $event->end_at = $request->end_at;

                if ($event->save()) {
                    return new EventResource($event);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $event = Event::findOrFail($id);
            return new EventResource($event);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            $rules = array(
                "name" => "required",
                "start_at" => "required",
                "end_at" => "required"
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $event = Event::findOrFail($id);
                $event->name = $request->name;
                $event->slug = Str::slug($request->name, '-');
                $event->start_at = $request->start_at;
                $event->end_at = $request->end_at;

                if ($event->save()) {
                    return new EventResource($event);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
        }
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
        try {
            $rules = array(
                "name" => "required",
                "start_at" => "required",
                "end_at" => "required"
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $event = Event::updateOrCreate(
                    ['slug' => Str::slug($request->name, '-')],
                    [
                        'name' => $request->name,
                        'start_at' => $request->start_at,
                        'end_at' => $request->end_at
                    ],

                );

                if ($event->save()) {
                    return new EventResource($event);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            if ($event->delete()) {
                return new EventResource($event);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error Please Contact Administrator');
        }
    }
}
