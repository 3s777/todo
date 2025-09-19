<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MissingException extends ModelNotFoundException
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Не найдено',
            'errors' => [
                'resource' => ['Не найдено'],
            ],
        ], Response::HTTP_NOT_FOUND);
    }
}
