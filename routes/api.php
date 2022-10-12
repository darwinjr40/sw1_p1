<?php

use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\PhotosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('api-events', EventApiController::class)->names('api-events');
Route::post('subirFile', [PhotosController::class, 'subirFile']);
Route::post('subirFile1', [PhotosController::class, 'subirFile1']);
Route::get('env', [PhotosController::class, 'env']);



