<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        return view('events/datatable');
    }

    public function create(){
        $type = 'create';
        $action = route('events.add-events');
        $form_type = 'POST';

        return view('events/create-edit', ['type' => $type, 'action' => $action, 'form_type' => $form_type]);
    }

    public function edit($id){
        $type = 'edit';
        $event = Event::where('id', $id)->first();
        $form_type = 'PUT';

        $action = route('events.update-events', $id);

        return view('events/create-edit', ['type' => $type, 'action' => $action, 'event' => $event, 'form_type' => $form_type]);
    }


}
