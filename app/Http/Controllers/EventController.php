<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        return view('events/index');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function create()
    {
        return view('events/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function show(Request $request)
    {
        return view('events/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return
     */
    public function edit()
    {
        return view('events/edit');
    }
}
