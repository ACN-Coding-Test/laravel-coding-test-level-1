<?php


namespace App\Helper;


use Illuminate\Support\Facades\Request;

class ApiResponse {
    public $message            = "";
    public $isSuccess          = false;
    public $data;

    /**
     *  example
     *  $controllerResponse = route('get.home')
     *  $controllerResponse = redirect->(route())
     *  $controllerResponse = redirect->back();
     */
    public $controllerResponse = null;

    public function __construct() {
        $this->controllerResponse = redirect()->back();

        $this->data = (object)[];
    }

    public function addData($datas){
        foreach($datas as $key=>$value){
            $this->data->{$key} = $value;
        }
        return $this;
    }



}


?>
