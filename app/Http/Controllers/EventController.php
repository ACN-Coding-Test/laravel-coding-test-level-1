<?php

namespace App\Http\Controllers;

use App\Helper\ApiResponse;
use App\Helper\Helper;
use App\Models\BaseModel;
use App\Models\EventModel;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;

class EventController extends Controller{
    //


    public function get($id = null, $isActiveEventOnly = false){


        return EventModel::handleBasicGet($id, function($builder) use ($isActiveEventOnly){
            if($isActiveEventOnly){
                 $builder->where('startAt', '<', now())->where('endAt', '>', now());
            }
        });


    }

    public function activeEvents(){
        return $this->get(null, true);
    }

    public function handleRestful($id = null){


        //# restful by model base, more model no need to do 1 by 1 or worst copy paste, simple CRUD task
        $response = EventModel::handleBasicRestFull($id, function(){
            \request()->validate([
                'endAt'   => 'required',
                'startAt' => 'required',
                'name'    => 'required',
                'slug'    => 'required|unique:event'
            ]);
        });
        return $response;

    }
}
