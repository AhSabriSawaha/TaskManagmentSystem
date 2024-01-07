<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TaskManagmentSystem\app\Exports\ProjectExport;
use Modules\TaskManagmentSystem\app\Http\Controllers\User\ProjectController;
use Modules\TaskManagmentSystem\app\Http\Controllers\User\ProjectInvitationController;

Route::group(['prefix' => 'projects', 'middleware' => 'auth:passport'], function () {


    Route::get('/index', [ProjectController::class, 'index']);
    Route::get('/{project}/show', [ProjectController::class, 'show']);
    Route::post('/store', [ProjectController::class, 'store']);
    Route::put('/{project}/update', [ProjectController::class, 'update']);
    Route::delete('/{project}/delete', [ProjectController::class, 'delete']);
    Route::post('/project/{project}/invite', [ProjectInvitationController::class, 'store'])->name('project.invite');
    Route::post('/invitation/accept/{token}', [ProjectInvitationController::class, 'acceptInvitation'])->name('invitation.accept');
    Route::get('/excel',function () {
        return Excel::download(new ProjectExport(), 'project.xlsx');
    });
});
