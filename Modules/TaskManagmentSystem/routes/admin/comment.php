<?php

use Illuminate\Support\Facades\Route;
use Modules\TaskManagmentSystem\app\Http\Controllers\Admin\CommentController;

Route::group(['prefix' => 'comments'], function () {


    Route::get('/index', [CommentController::class, 'index']);
    Route::get('/{comment}/show', [CommentController::class, 'show']);
    Route::post('/store', [CommentController::class, 'store']);
    Route::put('/{comment}/update', [CommentController::class, 'update']);
    Route::delete('/{comment}/delete', [CommentController::class, 'delete']);

});
