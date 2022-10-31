<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
class ViewController extends Controller
{
    //
    public function view()
    {
        $result=Event::get();
        return view('table',['result'=>$result]);
    }

    public function edit(request $request)
    {
        $result=Event::where('id','=',$request->id)->get();
        return view ('edit',['result'=>$result]);
       // return view('table',['result'=>$result]);
    }
    public function editdata(request $request)
    {
       

        $attributes = Validator::make($request->all(), [
            'name' => 'required|string',
            

            
        ]);

        Event::where('id',$request->id)
        ->update([
            
            'name' =>$request->name,
        ]);

        return redirect('/view');
      
       // return view('table',['result'=>$result]);
    }


}
