<?php

use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::controller(DocumentationController::class)->group(function () {
        Route::get('/', 'show')->name('home');
        Route::get('/api/v1/openapi.yaml', 'get')->name('openapi.v1.yaml');
    });
});
