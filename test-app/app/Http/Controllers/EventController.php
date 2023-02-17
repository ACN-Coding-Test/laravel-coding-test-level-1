<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return response()->view('event.list');
    }

    public function create()
    {
        return response()->view('event.create', ['userEmail' => Auth::user()->email]);
    }

    public function show(string $id)
    {
        return response()->view('event.show', ['id' => $id]);
    }

    public function edit(string $id)
    {
        return response()->view('event.edit', ['id' => $id]);
    }
}
