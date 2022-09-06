<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon;
use Artisan;
use App\Notifications\EventPublished;
use App\Models\User;
use Crypt;


class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::all();

        return response()->json([
            'status' => true,
            'message' => 'Event Retrieved',
            'data' => $events
        ]);
    }

    public function show(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Event Found',
            'data' => $event
        ]);
    }

    public function getActive(Request $request)
    {
        $events = Event::where('startAt', '<=', Carbon::now())->where('endAt', '>=', Carbon::now())->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Event Retrieved',
            'data' => $events
        ]);
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->description = $request->description;
        $event->createdAt = now();
        $event->updatedAt = now();
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $result = $event->save();

        // $input = $request->all();
        // $result = Event::create($input);

        if($result){
            return response()->json([
                'status' => true,
                'message' => 'Event Created',
                'data' => $event
            ]);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Failed to save Event'
            ]);
        }
    }

    public function put(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Updated',
                'data' => $event
            ]);
        }
        else
        {
            $event = new Event;
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->createdAt = now();
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Created',
                'data' => $event
            ]);
        }
    }

    public function patch(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event Updated',
                'data' => $event
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Event Not Found',
                'data' => null
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
    
        $event = Event::find($id);
        $event->delete();

        return response()->json([
            'status' => true,
            'message' => 'Event Deleted',
            'data' => $event
        ]);
    }

    public function store2(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->description = $request->description;
        $event->createdAt = now();
        $event->updatedAt = now();
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;

        if($event->startAt > $event->endAt || $event->endAt < $event->startAt){
            return redirect('events')->withFail('Invalid Dates!'); 
        }

        $event->save();

        // sending email
        $user = User::where('email', session()->get('email')) -> first();;
        $user->notify(new EventPublished($event));

        Artisan::call('cache:clear');

        return redirect('events')->withSuccess('Event Added Sucessfully!'); 
    }

    public function patch2(Request $request, $id)
    {
    
        $event = Event::find($id);
        if($event)
        {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->description = $request->description;
            $event->updatedAt = now();
            $event->startAt = $request->startAt;
            $event->endAt = $request->endAt;

            if($event->startAt > $event->endAt || $event->endAt < $event->startAt){
                return redirect('events')->withFail('Invalid Dates!'); 
            }

            $event->save();
            Artisan::call('cache:clear');
            return redirect('events')->withSuccess('Event Updated Sucessfully!');
        }
        else
        {
            return redirect('events')->withFail('Failed to update Event!');
        }
    }

    public function delete2(Request $request, $id)
    {
    
        $event = Event::find($id);
        $event->delete();

        Artisan::call('cache:clear');

        return redirect('events')->withSuccess('Event Deleted Sucessfully!');
    }

    public function search(Request $request)
    {
        if(isset($_GET['query'])){

            $events = Event::where('name', 'LIKE', '%'. $_GET['query'] .'%')->orderBy('createdAt')->paginate(5);
            $events->appends($request->all());

        }
        else{

            $currentPage = request()->get('page',1);
            $events = cache()->remember('events-'. $currentPage, 60*60*24, function(){
                return Event::orderBy('createdAt', 'DESC')->paginate(5);
            });
        }

        return view('events', compact('events'));
    }

    public function register(Request $request)
    {
        $user = new User();
        if($request->password != $request->confirmP){
            return redirect('register')->withFail('Password not match!');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Crypt::encrypt($request->password);
        $user->save();
        $request->session()->put('user', $request->name);
        $request->session()->put('email', $request->email);
        return redirect('events');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->get();

        if(count($user) < 1){
            return redirect('login')->withFail('User not found!');
        }

        if(Crypt::decrypt($user[0]->password) == $request->password){

            $request->session()->put('user', $user[0]->name);
            $request->session()->put('email', $request->email);

            return redirect('events');
        }
        
        return redirect('login')->withFail('User not found!');
        
    }

}
