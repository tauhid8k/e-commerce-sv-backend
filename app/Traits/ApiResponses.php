<?php

namespace App\Traits;

trait ApiResponses
{
    protected function success($message, $code = 200)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    protected function error($message = null, $code)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}
