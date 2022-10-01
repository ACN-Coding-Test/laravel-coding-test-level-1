<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redis;
use App\Event;
use Response;
use DataTables;

class EventsController extends Controller
{
    //VIEW
    public function events()
    {
        return view('events/index');
    }

    public function create()
    {
        return view('events/create');
    }

    public function edit($id)
    {
        $events = Event::find($id);
        
        return view('events/edit', compact('events'));
    }

    public function view($id)
    {
        $events = Event::find($id);
        
        return view('events/view', compact('events'));
    }

    public function delete($id)
    {
        $events = Event::findOrFail($id);
        Redis::del('delete' . $id);
        $events->delete();

        $notification = array(
            'message' => 'Delete Success.',
            'alert-type' => 'success'
        );
          
        return redirect()->to('/events')->with($notification);
    }


    ///API
    public function index()
    {
        $cachedList = Redis::get('event_list');
        if(isset($cachedBlog)) {
            $events = json_decode($cachedList, FALSE);

        }else{
            $events = Event::all();
            Redis::set('event_list', $events);
        }
        
        return Datatables::of($events)
        ->addIndexColumn()
        ->addColumn('action', function($row){

               $btn = ' 
               <a href="/events/'.$row->id.'" data-id="'.$row->id.'" title="View" id="viewdata" class="view btn btn-success btn-sm">View</a>
               <a href="/events/'.$row->id.'/edit" data-id="'.$row->id.'" title="Edit" id="editdata" class="edit btn btn-warning btn-sm">Edit</a>
               <a href="/events/'.$row->id.'/delete" data-id="'.$row->id.'"  onclick="deleteFunc()" title="Delete" id="delete" class="delete btn btn-danger btn-sm">Delete</a>
               ';

                return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
	
        return response()->json(['success'=> true, 'message'=>'All Event', 'data'=> $events]);
    }

    public function show($id)
    {
        $events = Event::find($id);
	
        return response()->json(['success'=> true, 'message'=>'Get one event', 'data'=> $events]);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:events',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);
        

        if($validator->fails()){    
            $notification = array(
                'message' => $validator->errors(),
                'alert-type' => 'error'
              );
              return redirect()->back()->with($notification);
        }

        $events = Event::create($request->all());

        if($events){
            $mails = [
                'title' => 'Event Mail',
                'body' => 'Your event has been created'
            ];
            \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\EventMail($mails));
        }

        $notification = array(
                'message' => 'Event created.',
                'alert-type' => 'success'
        );
              
        return redirect()->to('/events')->with($notification);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'slug' => 'string|unique:events',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);


        if($validator->fails()){
            $notification = array(
                'message' => $validator->errors(),
                'alert-type' => 'error'
              );
              return redirect()->back()->with($notification);       
        }
   
        $events = Event::updateOrCreate([
            'id' => $id,
        ], 
        [
            'name' => $request->name,
            'slug' => $request->slug,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt
        ]);

        if($events){
            // Delete event from Redis
            Redis::del('event' . $id);

            $eventlatest = Event::find($id);
            // Set a new key with the event
            Redis::set('event' . $id, $eventlatest);
        }

        $notification = array(
            'message' => 'Event updated.',
            'alert-type' => 'success'
        );
            
        return redirect()->to('/events')->with($notification);
    }



}
