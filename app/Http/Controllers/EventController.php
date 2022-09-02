<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http;
use App\Models\Event;

class EventController extends Controller
{

    public function __construct()
    {

    }
    
     public function index(Request $request)
    {
        $eventObj = new Event; 
        $keyword = '';
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $eventObj = $eventObj->where('name','like', '%'.$keyword.'%');
        }        
        $events = $eventObj->orderBy('createdAt','Desc')->paginate(10);
        return view('Event.index',compact('events','keyword'));
    }

    public function create(){        
        return View('event.create');
    }

    public function store(Request $request){
        $rules = array(
            'name' => 'required|string'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }else {
            
            $eventObj = new Event;
            $eventObj->name = $request->name;
            if(!empty($request->slug)){
                $eventObj->slug = $request->slug;
            }
            $eventObj->save();
            return redirect('events/'); 
        }
    }

    public function show(Event $event){
        return View('event.show',compact('event'));   
    }

    public function edit(Event $event){
       return View('event.edit',compact('event'));
    }

    public function update(Request $request,Event $event){
        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {            
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        } 
        $event->name =  $request->name;
        
        if(!empty($request->slug)){
            $event->slug = $request->slug;
        }
        
        $event->save();
        return redirect('events/');
    
    }

    public function delete(Event $event){
        $event->delete();
        return redirect('events/');
    }
    
}
