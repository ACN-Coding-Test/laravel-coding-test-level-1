<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Event;
use Carbon\Carbon;
use Validator;
use DB;
use App\Http\Resources\Event as EventResource;
use Illuminate\Support\Facades\Redis;

class EventController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pagination_limit  =   '5';
    }
    
    public function index()
    {
        $event = Event::orderBy('createdAt', 'desc')->get(); 
        return $this->sendResponse(new EventResource($event), 'all events retrieved successfully.');
    }    

    public function active_events(Request $request)
    {
        $data_all                   =   $request->all();              
        if ($data_all['startAt'] && $data_all['endAt']) {
            $startAt = Carbon::parse($data_all['startAt'])->toDateTimeString();
            $endAt = Carbon::parse($data_all['endAt'])->toDateTimeString();
            $data_result = Event::whereBetween('createdAt', [$startAt, $endAt])->get();
        } else {
            $data_result = [];
        }
        return $this->sendResponse(new EventResource($data_result), 'intervel events retrieved successfully.');
    }

    public function get_event($id)
    {
        $event = Event::find($id); 
        return $this->sendResponse(new EventResource($event), 'one events retrieved successfully.');
    }

    public function create_event(Request $request)
    {
        $input       =  $request->all(); 
        $validator   =  Validator::make($input, [
            'event_name'   => 'required|unique:events,name',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input_data['name']  =   $input['event_name'];
        $input_data['slug']  =   Str::slug($input['event_name']);
        $event = Event::create($input_data);
        return $this->sendResponse(new EventResource($event), 'event created successfully.');
    }

    public function update_event(Request $request, $id)
    {
        $input       =  $request->all(); 
        $event = Event::find($id);
        if($event){
            $validator   =  Validator::make($input, [
                'event_name'   => "required|unique:events,name,{$id}",
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }

            $input_data['name']  =   $input['event_name'];
            $input_data['slug']  =   Str::slug($input['event_name']);

            $event->update($input_data);
            $message    =   'event updated successfully.';
        }else{
            $validator   =  Validator::make($input, [
                'event_name'   => 'required|unique:events,name',
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            
            $input_data['name']  =   $input['event_name'];
            $input_data['slug']  =   Str::slug($input['event_name']);

            $event      =   Event::create($input_data);
            $message    =   'event created successfully.';
        }
        return $this->sendResponse(new EventResource($event), $message);
    }
    
    public function delete_event($id)
    {
        $event  = Event::find($id);
        if($event){
            $delete = $event->delete();
            if($delete==true){
                $data_response['id'] = $event->id;
                $message             = 'event made soft deleted successfully.'; 
            }else{
                $data_response['id'] = $event->id;
                $message             = 'something went wrong.';     
            }
        }else{
            $data_response['id'] = $id;
            $message             = 'this id not exist.';   
        }
        return $this->sendResponse($data_response, $message);        
    }

    public function event_list_web()
    {
        $event = Event::orderBy('createdAt', 'desc')->paginate($this->pagination_limit);
        return view('event.event_list', [
            'events' => $event,
            'search' => '0',
        ]);
    }
    
    public function event_show_web($id)
    {        
        $event = Event::find($id); 
        return view('event.event_show', compact('event'));
    }
    
    public function event_edit_web($id)
    {
        $event = Event::findOrFail($id);
        return view('event.event_edit', compact('event'));       
    }

    public function event_name_exist(Request $request)
    {
        $data_all               =           $request->all();  
        if(isset($data_all['event_id'])){
            if(isset($data_all['event_name'])){
                $exist_value                        =       DB::table('events')->where('events.name', $data_all['event_name'])->whereNotIn('events.id',[$data_all['event_id']])->get()->count();          
            }elseif(isset($data_all['event_slug'])){
                $exist_value                        =       DB::table('events')->where('events.slug', $data_all['event_slug'])->whereNotIn('events.id',[$data_all['event_id']])->get()->count();
            }
        }else{
            if(isset($data_all['event_name'])){
                $exist_value                        =       DB::table('events')->where('events.name', $data_all['event_name'])->get()->count();          
            }
        }
        if($exist_value > '0'){
            $count_status                       =       '0';
        }else{
            $count_status                       =       'true';
        }
        echo $count_status;
    }
    
    public function event_create_web()
    {       
        return view('event.event_create');
    }

    public function delete_event_web(Request $request)
    {
        $data_all = $request->all();  
        $event    = Event::find($data_all['event_id']);
        if($event){
            $delete = $event->delete();
            if($delete==true){
                $data_response['id'] = $event->id;
                $message             = 'event made soft deleted successfully.'; 
            }else{
                $data_response['id'] = $event->id;
                $message             = 'something went wrong.';     
            }
        }else{
            $data_response['id'] = $id;
            $message             = 'this id not exist.';   
        }
        return $this->sendResponse($data_response, $message);        
    }

    public function search_event_web(Request $request)
    {
        $data_all = $request->all();     
        $event = Event::where('events.id', 'like', '%' . $data_all['event_search_val'] . '%')->orWhere('events.name', 'like', '%' . $data_all['event_search_val'] . '%')->orWhere('events.slug', 'like', '%' . $data_all['event_search_val'] . '%')->orderBy('createdAt', 'desc')->paginate($this->pagination_limit);
        return view('event.event_list', [
            'events' => $event,
            'search' => '1',
        ]);    
    }
}


// echo "<pre>";
// print_r($data);
// echo "</pre>";
// exit();