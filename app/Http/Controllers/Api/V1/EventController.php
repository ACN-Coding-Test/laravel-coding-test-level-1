<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct(){
     
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	
    public function index()
    {
		$events = Event::all()->where('is_deleted',0);
		$response = array('success'=>true, 'message'=>'Event List', 'data'=>$events);
		return response()->json($response);
    }
	
    /**
     * Display a active listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */		
    public function activeEvents()
    {
		$date = date("Y-m-d");
		$events = Event::whereDate('created_at', '>=', $date)->where('is_deleted',0)->get();		
		$response = array('success'=>true, 'message'=>'Active Event List', 'data'=>$events);
		return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */	
    public function show($id)
    {
		$event = Event::find($id);		
		$response = array('success'=>true, 'message'=>'Event retrieved successfully', 'data'=>$event);
		return response()->json($response);
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */	
	public function store(Request $request)
    {		
		$validator = Validator::make($request->all(), [ 
			'name' => 'required|max:250', 
			'slug' => 'required|max:250|unique:events,slug',
		]);	
		
		if ($validator->fails()) { 
			$messages = $validator->messages();
			$response = array('success'=>false, 'message'=>$messages->first());
			return response()->json($response);
		}		
		
		$data = array(
			'name' => $request->name,
			'slug' => $request->slug,
			'created_at' => date("Y-m-d h:i:s"),
			'updated_at' => date("Y-m-d h:i:s"),
		);
		$event = Event::create($data);
		$response = array('success'=>true, 'message'=>'Event created successfully', 'data'=>$event);
		return response()->json($response);		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */	
    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), 
			[            
				'name' => 'required|max:250', 
				'slug' => 'required|max:250|unique:events,slug,'.$id,
			]
		);
		
		if ($validator->fails()) { 
			$messages = $validator->messages();
			$response = array('success'=>false, 'message'=>$messages->first());
			return response()->json($response);
		}		
		
		$data = array(
			'name' => $request->name,
			'slug' => $request->slug,
			'updated_at' => date("Y-m-d h:i:s"),
		);

		$event = Event::where('id',$id)->update($data);	
		$response = array('success'=>true, 'message'=>'Event updated successfully', 'data'=>$event);
		return response()->json($response);			
    }	
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {				
		$event = Event::where('id',$id)->update(['is_deleted' => 1]);		
		$response = array('success'=>true, 'message'=>'Event deleted successfully', 'data'=>$event);
		return response()->json($response);	
    }	
	
	
}
