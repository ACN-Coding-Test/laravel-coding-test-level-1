<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = Event::when($request->has("search"), function($q) use ($request){
          return $q->where("name","like","%".$request->get("search")."%");
        })
        ->where('is_deleted',0)
        ->paginate(5);

		    //$results = Event::where('is_deleted',0)->paginate(5);	
        return view('events.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), 
			[            
				'name' => 'required|max:250',
				'slug' => 'required|max:250|unique:events,slug',
			]
		);
		
		if ($validator->fails()) { 
			$messages = $validator->messages();
            return redirect()->back()->withInput($request->all())->with('error',$messages->first());
		}			
		
		$event = new Event([
            'name' => $request->name,
            'slug' => $request->slug,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);	

		if($event->save()){
            return redirect('/')->with('success','Event created successfully');
		}else{
            return redirect()->back()->withInput($request->all())->with('error','Please try again later!');
		}	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$result = Event::find($id);
		return view('events.edit',compact('result'));
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
            return redirect()->back()->withInput($request->all())->with('error',$messages->first());
		}			
		
        $data = array(
            'name' => $request->name,
            'slug' => $request->slug,
            'updated_at' => date("Y-m-d h:i:s"),
        );

		$event = Event::where('id',$id)->update($data);	
		if($event){
            return redirect('/')->with('success','Event updated successfully!');
		}else{
            return redirect()->back()->withInput($request->all())->with('error','Please try again later!');
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
		$event = Event::where('id',$id)->update(['is_deleted' => 1]);	
		if($event){
            return redirect('/')->with('success','Event deleted successfully!');
		}else{
            return redirect()->back()->withInput($request->all())->with('error','Please try again later!');
		}	
    }


}
