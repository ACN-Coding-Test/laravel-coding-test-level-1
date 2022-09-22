<?php


namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

abstract class BaseApiController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return success response
     *
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    public function sendResponse($data, $statusCode)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Return error response.
     *
     * @param string $errorMessages
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendError($errorMessages = '', $statusCode = 500)
    {
        return response()->json([
            'errors' => [
                'success' => false,
                'error' => $errorMessages
            ]
        ], $statusCode);
    }
}
