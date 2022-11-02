<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DatatableController extends Controller
{
    public function events()
    {
        $url = env('API_URL') . "/events";
        $events = file_get_contents($url);
        $events = json_decode($events);

        return DataTables::of($events->data)
            ->addColumn('show', function($row){
                $btn = $row->name.' <a href="/events/'.$row->id.'">[view]</a>';
                return $btn;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="/events/'.$row->id.'/edit" class="btn btn-primary btn-sm m-1"><i class="fas fa-pen"></i></a>';
                $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm m-1 delete_event"><i class="fas fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['show','action'])
            ->make(true);
    }
}
