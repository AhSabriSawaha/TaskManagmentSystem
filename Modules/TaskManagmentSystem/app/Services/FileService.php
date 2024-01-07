<?php

namespace Modules\TaskManagmentSystem\app\Services;

use Exception;

class FileService
{
    public static function uploadFile($model,$file,$collection) {
        try {
            if (!isset($file)) return;
            if (str_contains($file, config('app.url'))) {
                $file = str_replace(config('app.url'), "", $file);
                $model->addMedia(public_path($file))
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
            } else {

                $model->addMedia(public_path('temp/' . $file))
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
