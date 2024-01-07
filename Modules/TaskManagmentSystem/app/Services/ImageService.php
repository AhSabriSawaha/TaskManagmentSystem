<?php

namespace Modules\TaskManagmentSystem\app\Services;

use Exception;

class ImageService
{
    public static function uploadImage($model,$image,$collection) {
        try {
            if (!isset($image)) return;
            if (str_contains($image, config('app.url'))) {
                $image = str_replace(config('app.url'), "", $image);
                $model->addMedia(public_path($image))
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
            } else {

                $model->addMedia(public_path('temp/' . $image))
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
