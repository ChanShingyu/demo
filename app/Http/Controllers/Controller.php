<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function sendResponse($result, $message)
    {
        $headers = ['Content-Type' => 'application/json;charset=UTF-8', 'charset' => 'utf-8'];

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

/**
 * return error response.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function sendError($error, $errorMessages = [], $code = 200)
{
    $response = [
        'success' => false,
        'message' => $error,
    ];

    if (!empty($errorMessages)) {
        $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
}
}
