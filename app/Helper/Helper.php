<?php
namespace App\Helper;




use Illuminate\Http\Request;

class Helper{



    public static function isApi(){
        return preg_match('/.*\/api\/.*/', request()->url()) || request()->expectsJson();
    }
    public static function hybridResponse(ApiResponse $response){

        $routeDestination = $response->controllerResponse;
        if(static::isApi()){
            unset($response->controllerResponse);

            return response()->json($response);
        }else{
            if($routeDestination){
                if($routeDestination instanceof \Illuminate\View\View){
                    //# cannot add data in view
                    $datas = array_merge($routeDestination->getData(), (array)$response->data);
                    return view($routeDestination->getName(), $datas);
                }
                return $routeDestination;
            }else{
                return redirect()->back();

            }
        }
    }
}
