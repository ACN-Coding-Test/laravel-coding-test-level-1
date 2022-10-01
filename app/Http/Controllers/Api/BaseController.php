<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successResponse($data = null, $message = 'Success') {
        $response = [
            'success'   =>  true,
            'message'   => $message,
        ];

        if($data != null) {
            $response['data'] = $data;
        }

        return response()->json($response, 200);
    }

    public function errorResponse($errors = null, $message = 'An error occured.', $code = 422) {
        $response = [
            'success'   =>  false,
            'message'   =>  $message,
        ];

        if($errors != null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
