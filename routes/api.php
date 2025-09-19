<?php

use App\Exceptions\MissingException;
use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->name('api.v1.')
    ->middleware(['api'])
    ->missing(function () {
        throw new MissingException;
    })
    ->group(function () {
        Route::apiResource('tasks', TaskController::class);
    });
