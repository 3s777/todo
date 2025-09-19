<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends \Illuminate\Validation\ValidationException
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Ошибка валидации',
            'errors' => $this->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
