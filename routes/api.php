<?php

use App\Http\Controllers\Api\ProfileApiController;

Route::middleware('api')->prefix('admin')->group(function() {
    //Route::apiResource('profiles', App\Http\Controllers\Api\ProfileApiController::class);
    //Route::apiResource('experiences', App\Http\Controllers\Api\ExperienceApiController::class);
});

