<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use App\Models\User;
use App\Models\Event;

class EventController extends BaseController 
{
    public function index(Request $request)
    {
        $events = Event::get();
        return $this->sendResponse($events);
    }

    public function getActiveEvents(Request $request){
        if(empty($request->startAt) || empty($request->endAt)){
           return $this->sendError('Invalid Input', ['error'=>'startAt and endAt needed'],400);  
        }
        $from  = date('Y-m-d H:i:s',strtotime($request->startAt));
        $to  = date('Y-m-d H:i:s',strtotime($request->endAt));
        $events = Event::whereBetween('createdAt', [$from, $to])->get();
        return $this->sendResponse($events);
    }

    public function show(Event $event)
    {
        return $this->sendResponse($event);
    }


    public function store(Request $request){
        $rules = array(
            'name' => 'string|required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        } else {
            $eventObj = new Event;
            $eventObj->name = $request->name;
            if(!empty($request->slug)){
                $eventObj->slug = $request->slug;
            }
            try {
                $eventObj->save();
                return $this->sendResponse($eventObj,'Event saved successfully');
            } catch (QueryException $e) {
                return $this->sendError('Unable to save event.', ['error'=>$e->getMessage()]);
            }
        }
    }

    public function delete(Event $event){
        $event->delete();
        return $this->sendResponse(array());
    }

    public function update(Request $request, Event $event){
        $event->name = $request->name;
        if(!empty($request->slug)){
            $event->slug = $request->slug;
        }
        $event->save();
        return $this->sendResponse($event);
    }

    public function createOrUpdate(Request $request,$event=null)
    {   
        $rules = array(
            'name' => 'string|required'
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $event = empty($event) ? new Event:Event::find($event);
        $event->name = $request->name;
        if(!empty($request->slug)){
            $event->slug = $request->slug;
        }
        $event->save();
        return $this->sendResponse($event);

    }


    
}