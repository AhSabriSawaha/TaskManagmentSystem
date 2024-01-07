<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TaskManagmentSystem\app\Exports\TaskExport;
use Modules\TaskManagmentSystem\app\Http\Controllers\User\TaskController;

Route::group(['prefix' => 'tasks', 'middleware' => 'auth:passport'], function () {


    Route::get('/index', [TaskController::class, 'index']);
    Route::get('/{task}/show', [TaskController::class, 'show']);
    Route::post('/store', [TaskController::class, 'store']);
    Route::put('/{task}/update', [TaskController::class, 'update'])->middleware('check.owner', 'check.timeframe');
    Route::delete('/{task}/delete', [TaskController::class, 'delete']);
    Route::get('/excel',function () {
        return Excel::download(new TaskExport(), 'task.xlsx');
    });
});
