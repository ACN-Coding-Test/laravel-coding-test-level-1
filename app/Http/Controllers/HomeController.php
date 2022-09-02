<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $client = new Client();
        $res = $client->request('get', env("FREE_API_URL"));
        $apiList = new \stdClass();
        if ($res->getStatusCode() == 200) { 
            $apiList = json_decode($res->getBody()->getContents());
        }
        return view('home.index',compact('apiList'));
    }
}