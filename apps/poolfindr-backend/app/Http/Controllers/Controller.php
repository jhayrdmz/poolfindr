<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Return a response with an error
     *
     * @param  mixed $errorCode
     * @param  int $statusCode
     * @param  string $message
     * @param  array $metadata
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError(
        $errorCode,
        $statusCode = 400,
        $message = null,
        $metadata = []
    ): JsonResponse {
        $payload = [
            'message'    => $message ?: __($errorCode),
            'error_code' => $errorCode,
        ];

        if (filled($metadata)) {
            $payload = array_merge($payload, ['meta' => $metadata]);
        }

        return response()->json($payload, $statusCode);
    }

    /** 
     * Return response with message
     * 
     * @param string $message
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithMessage(string $message): JsonResponse
    {
        return response()->json(['message' => $message]);
    }

    /**
     * Return an empty data response.
     *
     * @param integer $statusCode
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithEmptyData($statusCode = 200): JsonResponse
    {
        return response()->json([], $statusCode);
    }
}
