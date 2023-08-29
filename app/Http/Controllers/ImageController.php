<?php

namespace App\Http\Controllers;

use App\Services\V1\Image\Image;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    /**
     * @param string $group
     * @param int $id
     * @param string $driver
     * @return JsonResponse
     */
    public function imageList(string $group, int $id, string $driver = Image::DRIVER_PUBLIC) : JsonResponse
    {
        $class = 'App\Models\\' . $group;
        if (class_exists($class)) {
            $model = $class::findOrFail($id);
            return Image::imageList($model, $driver);
        }

        abort(404);
    }

    /**
     * @param string|null $name
     * @return JsonResponse|string
     */
    public function getPublicImage(string $name = null) : JsonResponse|string
    {
        if (empty($name)) {
            abort(404);
        }

        return Image::getImage($name, Image::DRIVER_PUBLIC, 'model');
    }

    /**
     * @param string|null $name
     * @return JsonResponse|string
     */
    public function getImage(string $name = null) : JsonResponse|string
    {
        if (empty($name)) {
            abort(404);
        }

        return Image::getImage($name, Image::DRIVER_LOCAL, 'model');
    }

    /**
     * @param string|null $name
     * @param string $driver
     * @param string $type
     * @return JsonResponse
     */
    public function deleteSingleImage(string $name = null, string $driver = Image::DRIVER_PUBLIC, string $type = 'model') : JsonResponse
    {
        if (empty($name)) {
            abort(404);
        }

        return Image::deleteSingleImage($name, $type, $driver);
    }
}
