<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::apiResource('/task', 'App\Http\Controllers\TaskController');
    Route::apiResource('/user', 'App\Http\Controllers\UserController');
});

Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:api')->name('logout');


    Route::apiResource('/tasktest', 'App\Http\Controllers\TaskController');
    Route::apiResource('/usertest', 'App\Http\Controllers\UserController');




