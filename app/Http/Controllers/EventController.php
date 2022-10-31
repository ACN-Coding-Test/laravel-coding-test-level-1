<?php

namespace App\Http\Controllers;
use App\Models\event; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //
public function search(request $request)
{
$result=event::where('name','LIKE',"%{$request->search}%")->orwhere('slug','LIKE',"%{$request->search}%")->get();


return view('pages.laravel-examples.user-management',['result'=>$result]);
}

    public function eventcreate(request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:events',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);
        
        if($validator->fails()){
            return response()->json(['message' => 'Validation Error.','error'=>$validator->errors()], 401);         
        }

        $new= new event();
        $new->name=$request->name;
        $new->slug=$request->slug;
        $new->startAt=$request->startAt;
        $new->endAt=$request->endAt;
    //    $new->deleted_at=now();
        $new->updated_at=now();
        $new->created_at=now();

        $new->save();
        return redirect('user-management');  
    }

    public function create()
    {
        
       
        return  view('pages.laravel-examples.add-user-profile');
    }

    public function show(request $request)
    {
        $events = event::where('id', '=', $request->id)->get();
       
        return  view('pages.laravel-examples.user-profile',['result'=>$events]);
    }

    public function edit(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'startAt' => 'required|date',
            'endAt' => 'required|date'
        ]);
        
        if($validator->fails()){
            return response()->json(['message' => 'Validation Error.','error'=>$validator->errors()], 401);         
        }
    
    
        $events = Event::where('id', '=', $request->id)->get();
        if($events[0]->slug==$request->slug)
        {
            Event::where('id',$request->id)
            ->update([
                
                'name' =>$request->name,
                //'slug' =>$request->slug,
                'startAt' =>$request->startAt,
                'endAt' =>$request->endAt,
                'updated_at' =>now(),
               
               
            ]);
            return redirect('user-management');  
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'slug' => 'string|unique:events',
                'startAt' => 'required|date',
                'endAt' => 'required|date'
            ]);
            
            if($validator->fails()){
                return response()->json(['message' => 'Validation Error.','error'=>$validator->errors()], 401);         
            }

            Event::where('id',$request->id)
            ->update([
                
                'name' =>$request->name,
                'slug' =>$request->slug,
                'startAt' =>$request->startAt,
                'endAt' =>$request->endAt,
                'updated_at' =>now(),
               
               
            ]);
            return redirect('user-management');  
        }
       
    }

    public function delete(request $request)
    {
        Event::where('id',$request->id)
        ->update([
            
           
            'deleted_at' =>now(),
           
           
        ]);
        return redirect('user-management');  
    }
}
