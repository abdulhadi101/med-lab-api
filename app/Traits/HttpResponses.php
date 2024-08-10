<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $message =null, $code=200): \Illuminate\Http\JsonResponse
    {

        return response()->json([
            'status' => 'Request was Successful.',
            'message' => $message,
            'data' => $data
        ], $code);

    }

    protected function error($data, $code, $message =null ): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Request was not Successful.',
            'message' => $message,
            'errors' => $data
        ], $code);

    }

}
