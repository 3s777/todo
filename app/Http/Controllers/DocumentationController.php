<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class DocumentationController extends Controller
{
    public function show(): Factory|View
    {
        return view('documentation');
    }

    public function get(): JsonResponse
    {
        return new JsonResponse(
            data: File::get(resource_path('openapi/v1/v1.yaml')),
            json: true,
        );
    }
}
