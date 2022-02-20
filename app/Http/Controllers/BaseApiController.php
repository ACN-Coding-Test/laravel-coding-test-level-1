<?php

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;
use App\Http\Responses\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class BaseApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        try {

            $response = call_user_func_array([$this, $method], $parameters);

            if ($response instanceof MessageBag) {
                return JsonResponse::error(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response);
            }

            return JsonResponse::success($response);
        } catch (\Throwable $th) {

            return JsonResponse::error(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}
