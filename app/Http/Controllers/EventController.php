<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();

        return response()->json([
            'code' => 200,
            'success' => true,
            'result' => $events
        ]);
    }

    public function indexActive()
    {
        $events = Event::whereDate('start_at','<=', now())
        ->whereDate('end_at','>=', now())
        ->get();;

        return response()->json([
            'code' => 200,
            'success' => true,
            'result' => $events
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
        try {
            $events = Event::create([
                // 'uuid' => $request->language,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
            ]);
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $events
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'success' => false,
                'data' => []
            ]);
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
        $events = Event::find($id);

        return response()->json([
            'code' => 200,
            'success' => true,
            'result' => $events
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
    public function updateCreate(Request $request, $id)
    {

        $events = Event::find($id);

        try{
            if(isset($events)){
                $events->name = $request->name ? $request->name : $events->name;
                $events->slug = $request->slug ? $request->slug : $events->slug;
                $events->start_at = $request->start_at ? $request->start_at : $events->start_at;
                $events->end_at = $request->end_at ? $request->end_at : $events->end_at;
                $events->save();
            }else{
                $events = Event::create([
                    'id' => $id,
                    'name' => $request->name,
                    'slug' => Str::slug($request->slug),
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                ]);
            }

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $events,
                'message' => 'Data has been updated/created successfully!'
            ]);

        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'success' => false,
                'data' => [],
                'message' => 'Data failed to update/create successfully.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $events = Event::find($id);
            $events->name = $request->name ? $request->name : $events->name;
            $events->slug = $request->slug ? $request->slug : $events->slug;
            $events->start_at = $request->start_at ? $request->start_at : $events->start_at;
            $events->end_at = $request->end_at ? $request->end_at : $events->end_at;
            $events->save();

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $events,
                'message' => 'Data has been updated successfully!'
            ]);

        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'success' => false,
                'data' => [],
                'message' => 'Data failed to update.'
            ]);
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
        $events = Event::findOrFail($id);

        try{
            $events->delete();
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Successfully Deleted!'
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'data' => [],
                'message' => 'Ops!!! Something is wrong.'
            ]);
        }
    }
}
