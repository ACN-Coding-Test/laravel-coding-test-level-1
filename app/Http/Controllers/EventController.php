<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    private $session_id;

    public function __construct()
    {
        $this->session_id = Cookie::get('session_id');
        if ($this->session_id==null) {
            Redirect::to('login')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session_id = $this->session_id;

        return view('events.index',compact(['session_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session_id = $this->session_id;
        $type = 'create';

        return view('events.form',compact('type','session_id'));
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $session_id = $this->session_id;
        $type = 'show';
        $url = env('API_URL') . "/events/".$request->event;
        $response = callApi('GET', $url, false, false, $session_id);
        $response = json_decode($response['data']);
        $event = $response->data;

        if ($event) {
            return view('events.form',compact('type','event','session_id'));
        } else {
            return redirect('/events')->withErrors(['message'=>'Event not found.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $session_id = $this->session_id;
        $type = 'update';
        $url = env('API_URL') . "/events/".$request->event;
        $response = callApi('GET', $url, false, false, $session_id);
        $response = json_decode($response['data']);
        $event = $response->data;

        if ($event) {
            return view('events.form',compact('type','event','session_id'));
        } else {
            return redirect('/events')->withErrors(['message'=>'Event not found.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
