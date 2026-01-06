<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    Route::resource('profiles', App\Http\Controllers\Admin\ProfileController::class);
    Route::resource('profiles.techstacks',App\Http\Controllers\Admin\TechStackController::class)->shallow();
    Route::resource('profiles.experiences', App\Http\Controllers\Admin\ExperienceController::class)->shallow();
    Route::resource('profiles.educations', App\Http\Controllers\Admin\EducationController::class)->shallow();
    Route::resource('profiles.projects', App\Http\Controllers\Admin\ProjectController::class)->shallow();
});



