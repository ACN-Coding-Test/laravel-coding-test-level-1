<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class crudcontroller extends Controller
{
    //

    public function adddummy()
    {
        $new= new Event();

        $new->name="Api_1";
        $new->slug="Slug_1";
        $new->createdAt=now();
        $new->updatedAt=now();

        $new->save();
        print('test');
    }
    public function events()
    {
        $result=Event::get();

        return response(['data'=>$result]);
    }
 

public function functionevents(request $request)
{


    if($request->isMethod('delete'))
    {

        if(Event::where('id', '=',$request->id)->first())
        {
            Event::where('id',$request->id)
            ->update([
                
                'deleted_at' =>now(),
            ]);
            return response()->json(['data'=>"soft delete Done"], 401);
        }

      

       
    }
    if($request->isMethod('post'))
    {
       
     
        $attributes = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug'=>'required',
            'createdAt'=>'required',
            'updatedAt'=>'required'

            
        ]);
        if($attributes->fails())
        {
            return response()->json(['error'=>$attributes->errors()], 401);
        }

        $new= new Event();

        $new->name=$request->name;
        $new->slug=$request->slug;
    
        $new->createdAt=$request->createdAt;
        $new->updatedAt=$request->updatedAt;

        $new->save();

        return response()->json(['data'=>'success'],201);


    }
    if($request->isMethod('put'))
    {

        $attributes = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug'=>'required',
            'createdAt'=>'required',
            'updatedAt'=>'required'

            
        ]);
        if($attributes->fails())
        {
            return response()->json(['error'=>$attributes->errors()], 401);
        }


      

        

       if(Event::where('id', '=',$request->id)->first())
        {
            Event::where('id',$request->id)
            ->update([
                
                
                'name' =>$request->name,
              //  'slug' =>$request->slug,
                'createdAt' =>$request->createdAt,
                'updatedAt' =>$request->updatedAt,
               
            ]);

            
        return response()->json(['data'=>'update success'],201);
        }

      else
      {
      
        $new= new Event();

        $new->name=$request->name;
        $new->slug=$request->slug;
        $new->createdAt=now();
        $new->updatedAt=now();

        $new->save();
        return response()->json(['data'=>'insert success'],201);
      }
   
    }
    if($request->isMethod('get'))
    {
 $result=Event::where('id','=',$request->id)->get();

        return response(['data'=>$result]);
    }


    if($request->isMethod('patch'))
    {

        $attributes = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
        if($attributes->fails())
        {
            return response()->json(['error'=>$attributes->errors()], 401);
        
           
        }
        else
        {
            Event::where('id',$request->id)
            ->update([
                
                'name' =>$request->name,
            ]);
          
        }

        
    }
}



}
