<?php

use Illuminate\Support\Facades\Route;
use Modules\TaskManagmentSystem\app\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'users'], function () {


    Route::get('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/{user}/show', [UserController::class, 'show']);
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/{user}/update', [UserController::class, 'update']);
    Route::delete('/{user}/delete', [UserController::class, 'delete']);

});
