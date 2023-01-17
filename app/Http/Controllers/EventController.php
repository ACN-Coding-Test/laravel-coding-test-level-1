<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


//$seeder = new \Database\Seeds\WantedSeeder();

class EventController extends Controller
{
    // Get All Events
    public function all_events() {
        
        $all_events = Event::all();
        return json_encode( $all_events );
    }

    // Get All Active Events
    public function active_events() {

        $now = Carbon::now()->toDateString();
        $active_events = Event::whereRaw("startAt <=  date('$now')")
                        ->whereRaw("endAt >=  date('$now')")
                        ->get();
        return json_encode( $active_events );
    }

    // Create New Event
    public function create_event() {
        
        Event::create([
            'name' => "dar",
            "slug" => "dar",
            "startAt" => date( "Y/m/d" ),
            "endAt" => date( "Y/m/d" ),
            "createdAt" => date( "Y/m/d" ),
            "updatedAt" => date( "Y/m/d" )
        ]);
        return json_encode( "success" );
    }

    // GET, DELETE, UPDATE Event By Id
    public function event( Request $request, $id ) {

        if( $request->method() === "GET" ) {

            $event = Event::where("id", $id)->get();
            $response = $event;
        } else if( $request->method() == "PUT" ) {
            
            $event = Event::where("id", $id)->get();
            if( $event->isEmpty() ) {

                $new_event = new Event;
                $new_event->id = $id;
                $new_event->name = "check";
                $new_event->slug = "check";
                $new_event->startAt = date("Y/m/d");
                $new_event->endAt = date("Y/m/d");
                $new_event->createdAt = date("Y/m/d");
                $new_event->updatedAt = date("Y/m/d");
                $new_event->save();

                $response = "Inserted Successfully";
            } else {
                $response = "Fail";
            }
        } else if( $request->method() == "DELETE" ) {

            $event = Event::where("id", $id)->get();
            
            if( !$event->isEmpty() ) {

                Event::where( 'id', $id )->delete();
                $response = "Deleted Successfully";
            } else {

                $response = "No Record To Delete";
            }
        }

        return $response;
    }

    public function events() {

        $events = Event::all()->toArray();
        return view('Events',['event_list' => $events]);
    }
}
