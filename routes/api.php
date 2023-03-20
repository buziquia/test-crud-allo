<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/user', UserController::class);
    Route::apiResource('/task', TaskController::class);
});

Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:api')->name('logout');

Route::apiResource('/task/test', TaskController::class);
