<?php

namespace App\Http\Controllers;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class eventinfocontroller extends Controller
{
    //
    public function events()
    {
    $result=event::get();
    return response()->json(['data' => $result], 201);
    }
    public function activeevents(request $request)
    {
       
        $validator = Validator::make($request->all(), [
           
            'date' => 'required|date'
        ]);
        
        if($validator->fails()){
            return response()->json(['message' => 'Validation Error.','error'=>$validator->errors()], 401);         
        }
    $events = Event::where('startAt', '<=',  $request->date)->where('endAt', '>=', $request->date)->get();
    return response()->json(['data' => $events], 201);

    }

    public function eventsinfo(request $request)
    {
if($request->isMethod('put'))
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


    $events = Event::where('id', '=', $request->id)->get();
    if($events->count()>0)
    {
        Event::where('id',$request->id)
        ->update([
            
            'name' =>$request->name,
            'slug' =>$request->slug,
            'startAt' =>$request->startAt,
            'endAt' =>$request->endAt,
            'updated_at' =>now(),
           
           
        ]);

        return response()->json(['message' => 'data update Succesfully'], 201);     
    }
    else
    {

        $new= new event();
        $new->name=$request->name;
        $new->slug=$request->slug;
        $new->startAt=$request->startAt;
        $new->endAt=$request->endAt;
    //    $new->deleted_at=now();
        $new->updated_at=now();
        $new->created_at=now();

        $new->save();
        return response()->json(['message' => 'data insert Succesfully'], 201);
    }

    

  

}
if($request->isMethod('patch'))
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


    $events = Event::where('id', '=', $request->id)->get();
    if($events->count()>0)
    {
        Event::where('id',$request->id)
        ->update([
            
            'name' =>$request->name,
            'slug' =>$request->slug,
            'startAt' =>$request->startAt,
            'endAt' =>$request->endAt,
            'updated_at' =>now(),
           
           
        ]);

        return response()->json(['message' => 'data update Succesfully'], 201);     
    }
    else
    {

       
        return response()->json(['error' => 'User Not Found'], 404);
    }

    

}
if($request->isMethod('post'))
{
    $new= new event();
        $new->name=$request->name;
        $new->slug=$request->slug;
        $new->startAt=$request->startAt;
        $new->endAt=$request->endAt;
    //    $new->deleted_at=now();
        $new->updated_at=now();
        $new->created_at=now();

        $new->save();
        return response()->json(['message' => 'data insert Succesfully'], 201);
   
}
if($request->isMethod('get'))
{
    $events = Event::where('id', '=', $request->id)->get();
    if($events->count()>0)
    {
        return response()->json(['data' => $events], 201);
    }
    else
    {
        return response()->json(['error' => 'user not found'], 401);
    }
   
}
if($request->isMethod('delete'))
{
    $events = Event::where('id', '=', $request->id)->get();
    if($events->count()>0)
    {
        Event::where('id',$request->id)
        ->update([
            
           
            'deleted_at' =>now(),
           
           
        ]);

        return response()->json(['message' => 'data delete Succesfully'], 201);     
    }
    else
    {

       
        return response()->json(['error' => 'User Not Found'], 404);
    }
}
    }
}
