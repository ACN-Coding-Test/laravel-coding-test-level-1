<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;

class EventController extends Controller
{
    public function getAllEvents(){

        $events = Event::all();

        return Datatables::of($events)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return $this->getActionColumn($row);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    protected function getActionColumn($data): string {
        
        // $editUrl = route('admin.shop.collection.edit', $data['id']);
        $editUrl = route('events.edit', $data->id);
        $data_id = $data->id;
        // $data_href = route('public.shop.collection-item-list', $data['slug']);
        $data_href = '#';
        $data_name = $data->name;
        // $data_item_count = count($data['items']);
        $data_item_count = '';
        $deleteUrl = route('events.delete-events', $data->id);

        // $preview_buton = "<a target='_blank' class='waves-effect btn-sm btn-secondary' href='$data_href'>Preview</a>";
        $edit_button = "<a class='waves-effect btn-sm btn-primary' href='$editUrl'>Edit</a>";
        $delete_button = "<a class='btn-sm btn-danger dt-delete-btn' data-id='$data_id' data-name='$data_name' data-count-item='$data_item_count' href='$deleteUrl'>Delete</a>";

        $res = $edit_button . " ";
        $res = $res . $delete_button;

        return $res;

    }

    public function getActiveEvents(){
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $result = Event::where('startAt', '<', $now)
                        ->where('endAt', '>', $now)->get();

        if(is_null($result)){
            return response()->json(['message' => 'There is no active events!'], 404);
        }

        return response()->json($result, 200);
    }

    public function getEventByID($id){
        $result = Event::where('id', $id)->first();

        if(is_null($result)){
            return response()->json(['message' => 'Event not found!'], 404);
        }

        return response()->json($result, 200);
    }

    public function addEvent(Request $request){
        $uuid = Str::uuid()->toString();
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $event = Event::create([
                                'id' => $uuid,
                                'name' => $request->name,
                                'slug' => $request->slug,
                                'createdAt' => $now,
                                'updatedAt' => $now,
                                'startAt' => $request->startAt,
                                'endAt' => $request->endAt,
                                ]);

        return redirect('/events');
    }

    public function updateEvent(Request $request, $id){
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $uuid = Str::uuid()->toString();
        
        $event = Event::UpdateOrCreate([
            'id' => $id
         ],
         [
            'id' => $uuid,
            'name' => $request->name,
            'slug' => $request->slug,
            'updatedAt' => $now,
            'startAt' => $request->startAt,
            'endAt' => $request->endAt,
        ]);

        return redirect('/events');
    }

    public function partialUpdateEvent(Request $request, $id){
        $event = Event::find($id);
        $now = Carbon::now()->format('Y-m-d H:i:s');

        if(is_null($event)){
            return response()->json(['message' => 'Event not found!'], 404);
        }

        if($request->name){
            $event->name = $request->name;
        }
        if($request->slug){
            $event->slug = $request->slug;
        }
        if($request->startAt){
            $event->startAt = $request->startAt;
        }
        if($request->endAt){
            $event->endAt = $request->endAt;
        }

        if($request){
            $event->updatedAt = $now;
        }
        $event->save();

        return response($event, 200);
    }

    public function deleteEvent($id){
        $event = Event::find($id);

        if(is_null($event)){
            return response()->json(['message' => 'Event not found!'], 404);
        }

        $event->delete();
        return view('/events');
    }
}
