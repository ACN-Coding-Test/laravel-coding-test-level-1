<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('event.list', compact('events'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $date = $request->date;
        $date = explode(' - ', $date);

        $event = new Event();
        $event->id = Str::uuid();
        $event->name = $request->name;
        $event->slug = Str::slug($request->name);
        $event->created_at = date('Y-m-d H:i:s');
        $event->startAt = $date[0];
        $event->endAt = $date[1];
        $save = $event->save();

        if($save){
            Session::flash('success', 'Event Succesfully Created'); 
            return Redirect::to(url('/events'));
        }else{
            return Redirect::to(url('/events/create'));
        }
    }

    public function view($id)
    {
        $event = Event::find($id);
        return view('event.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $date = $request->date;
        $date = explode(' - ', $date);

        $event = Event::find($id);
        $event->name = $request->name;
        $event->slug = Str::slug($request->name);
        $event->startAt = $date[0];
        $event->endAt = $date[1];
        $save = $event->save();

        if($save){
            Session::flash('success', 'Event Succesfully Updated'); 
            return Redirect::to(url('/events'));
        }else{
            return Redirect::to(url('/events/edit/'.$id));
        }
    }

    public function delete($id){
        $event = Event::where("id", $id)->get();
        if(!$event->isEmpty()) {
            Event::where('id', $id )->delete();
            Session::flash('success', 'Event Succesfully Deleted'); 
            return Redirect::to(url('/events'));
        } else {
            Session::flash('failed', 'Event Fail to delete'); 
            return Redirect::to(url('/events'));
        }
    }
}
