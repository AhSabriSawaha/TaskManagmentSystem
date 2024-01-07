<?php

use Illuminate\Support\Facades\Route;
use Modules\TaskManagmentSystem\app\Http\Controllers\User\UserController;


Route::group(['prefix' => 'users'],  function () {
    Route::post('/store', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'login']);

});
Route::group(['prefix' => 'users', 'middleware' => 'auth:passport'], function () {

    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/{user}/show', [UserController::class, 'show']);
    Route::put('/{user}/update', [UserController::class, 'update']);
    Route::delete('/{user}/delete', [UserController::class, 'delete']);

});
