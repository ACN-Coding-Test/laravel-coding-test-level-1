<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success_message')) {
                Alert::success('Success!', session('success_message'));
            }

            if (session('error_message')) {
                Alert::error('Error!', session('error_message'));
            }

            return $next($request);
        });
    }
}
