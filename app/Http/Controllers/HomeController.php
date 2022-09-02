<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
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
        $cacheKey = "FreeApiList";
        $redis = Redis::connection();
        $apiListCache = $redis->get($cacheKey);
        if(isset($apiListCache)) {
            $apiList = json_decode($apiListCache);
        }else{
            $client = new Client();
            $res = $client->request('get', env("FREE_API_URL"));
            $apiList = new \stdClass();
            if ($res->getStatusCode() == 200) { 
                $data = $res->getBody()->getContents();
                $apiList = json_decode($data);
                $redis->set($cacheKey, $data);
            }
        }
        return view('home.index',compact('apiList'));
    }
}