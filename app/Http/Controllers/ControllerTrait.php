<?php

namespace App\Http\Controllers;

trait ControllerTrait
{
    protected function sendResponseApi($message, $code = 1, $data = null){
        $headers = [];
        $options = JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;

	    $s = response()->json(
            [
                'status' => true,
                'message' => $message,
                'data' => $data,
                'error' => null,
            ],
            $this->getHttpStatusCode($code),
            $headers,
            $options
        );
    	return $s;
    }

    /**
    * Retrives http code, based on application error code. 
    * 
    * @param $code 0: no error, > 0: has errors.
    */
    protected function getHttpStatusCode($code){

        $httpStatusCode = 200;

        $codeNum = (int)preg_replace("/[^0-9]/", '', $code);

        /**
        * Application error code range: 
        * 2 - 29 : Request errors.
        * 201 - 499: Application domain validation.
        * 501 - 899: Application domain processing errors.
        * 901 - 999: API traffic issues (throttling).
        * 1000: General catch all error.
        */

        // Bad request
        if($codeNum >= 2 && $codeNum < 30){
            
            $httpStatusCode = 400;

        }
        // Application domain validation
        elseif($codeNum >=  201 && $codeNum < 500){

            //$httpStatusCode = 500;  //Unauthorized
            $httpStatusCode = 400;  //Unauthorized

        }
        // Application domain processing errors
        elseif($codeNum >=  501 && $codeNum < 899){

            //$httpStatusCode = 500;  //
            $httpStatusCode = 400;  //

        }
        // API traffic issues (throttling)
        elseif($codeNum >=  901 && $codeNum < 1000){

            $httpStatusCode = 429;  //

        }
        // catch all
        elseif($codeNum == 1000)
        {
            $httpStatusCode = 500;
        }

        return $httpStatusCode;
    }
}
