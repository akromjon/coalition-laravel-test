<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse($data, $code = 200)
    {
        return response()->json([
            'data' => $data,
            'status' => 'success',
        ], $code);
    }

    public function notFoundResponse($message = 'Not found!')
    {
        return response()->json([
            'message' => $message,
            'status' => 'error',
        ], 404);
    }

    public function errorResponse($message = 'Error occurred!', $code = 500)
    {
        return response()->json([
            'message' => $message,
            'status' => 'error',
        ], $code);
    }

    public function validationErrorResponse($errors)
    {
        return response()->json([
            'message' => 'Validation error occurred!',
            'status' => 'error',
            'errors' => $errors,
        ], 422);
    }


}
