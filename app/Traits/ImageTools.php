<?php

namespace App\Traits;

use App\Services\V1\Image\Image;
use Illuminate\Auth\Access\AuthorizationException;

trait ImageTools {
    public array $imageList = [];


    /**
     * @param string $name
     * @return void
     * @throws AuthorizationException
     */
    public function deleteImage(string $name): void
    {
        $explode = explode('-', $name);
        $className = 'App\Models\\' . $explode[0];
        $id = (int) $explode[1];

        $this->authorize('update', $className);

        $model = $className::find($id);
        if ($name) {
            $response = Image::deleteSingleImage($name, Image::TYPE_MODEL, Image::DRIVER_PUBLIC)->getData()->status;
            if ($response) {
                $this->imageList = Image::imageList($model, Image::DRIVER_PUBLIC)->getData()->paths;
            }
        }
    }
}
