<?php

namespace App\Traits;

trait RespondsWithHttpStatus
{
    protected function success($message, $data, $status = 200)
    {
        return response([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = 422)
    {
        return response([
            'status' => false,
            'message' => $message,
        ], $status);
    }
}