<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        return new EventCollection(Event::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name'=>'required|string',
            'slug'=>'string|unique:events',
            'startAt'=>'required|date',
            'endAt'=>'required|date'
        ]);

        if ($validator->fails()) {
          return  ['data'=>null,
                    'errors'=>$validator->messages()
                ];
        }
        
        if(!$request->slug)
        {
            $validatedData['slug'] = Str::slug($request->name);
        }

        $count = Event::where('slug','like','%'.$validatedData['slug'].'%')->count();
        if($count>0)
        {
            $validatedData['slug'] = $validatedData['slug'].$count; 
        }

        $validatedData['id']= Str::uuid();
        $event=   Event::create($validatedData);
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event  = Event::find($id);
        if($event)
        {
            return new EventResource($event);
        }
        else{
            return response()->json(['data'=>null]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $event = Event::find($id);

        if ($event && $request->isMethod('PATCH')) {
            if($request->name)
            {
                $event->name = $request->name;
            }
            if($request->slug)
            {
                $event->slug = $request->slug;
            }
            if($request->startAt)
            {
                $event->startAt = $request->startAt;
            }
            if($request->endAt)
            {
                $event->endAt = $request->endAt;
            }
            $event->updated_at = now();
            $event->save();
            return new EventResource(Event::find($id));
    
        }
        else{
            $validatedData  = $request->all();
            
            $validator = Validator::make($request->all(), [
                'name'=>'required|string',
                'slug'=>'required|string',
                'startAt'=>'required|date',
                'endAt'=>'required|date'
            ]);
    
            if ($validator->fails()) {
              return  ['data'=>null,
                        'errors'=>$validator->messages()
                    ];
            }

           if(!Str::isUuid($id))
           {
                return  ['data'=>null,
                        'errors'=>['provided resource id is not a valid UUID.']
                    ];
           }
           else{
               $validatedData['id'] = $id;
           }
            
            if(!$request->slug)
            {
                $validatedData['slug'] = Str::slug($request->name);
            }

            
            $count = Event::where('slug','like',$validatedData['slug'])->where('id','!=',$id)->count();
            if($count)
            {
                $validatedData['slug'] = $validatedData['slug'].($count+1); 
            }

            $event = Event::find($id);

            if($event )
            {
                
                $event->name = $validatedData['name'];
                $event->slug = $validatedData['slug'];
                $event->startAt = $validatedData['startAt'];
                $event->endAt = $validatedData['endAt'];
                $event->save();

            }
            else{                
                $event = Event::create($validatedData);
            }
            
            return new EventResource(Event::find($id));
        }       
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if($event){
            $event->delete();
            return response()->json(['message'=>"evnet with id:".$id." is deleted successfuly"]);
        }
        else{
            return response()->json(['message'=>"resource not found"]);
        }
        
    }
}
