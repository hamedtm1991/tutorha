<?php

namespace App\Services\V1\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * @param Model $model
     * @param array $images
     * @param string $driver
     * @return bool
     */
    public function modelImages(Model $model, array $images, string $driver) : bool
    {
        $modelName = $this->modelName($model);

        $numberOfFilesForId = 0;
        $main = true;
        foreach (Storage::disk($driver)->allFiles('models/' . $modelName) as $path) {
            if(str_contains($path, $modelName . '-' . $model->id)) {
                $numberOfFilesForId ++;

                if (str_contains($path, 'main')) {
                    $main = false;
                }
            }
        }

        $directory = $this->directory($model);
        foreach($images as $image)
        {
            $name = $main ? 'main' : mt_rand(1, 100000);

            $respond = Storage::disk($driver)->putFileAs($directory, $image, $modelName . '-' . $model->id . '-' . $name);

            if (!$respond) {
                return false;
            }

            $main = false;
        }

        return true;
    }

    /**
     * @param Model $model
     * @param string $driver
     * @return bool
     */
    public function deletingModelImages(Model $model, string $driver) : bool
    {
        $directory = $this->directory($model);
        return Storage::disk($driver)->deleteDirectory($directory);
    }

    /**
     * @param Model $model
     * @param string $driver
     * @return JsonResponse
     */
    public function imageList(Model $model, string $driver) : JsonResponse
    {
        $directory = $this->directory($model);
        if($driver === Image::DRIVER_LOCAL) {
            if (Auth::check() && Auth::user()->can(strtolower($this->modelName($model)) . '.show')) {
                $files = Storage::disk(Image::DRIVER_LOCAL)->files($directory);
            } else {
                return abort(403);
            }
        } else if ($driver === Image::DRIVER_PUBLIC) {
            $files = Storage::disk(Image::DRIVER_PUBLIC)->files($directory);
        }

        return response()->json([
            'paths' => $this->fileNames($files),
        ], 200);
    }

    /**
     * @param string $name
     * @param string $driver
     * @param string $type
     * @return JsonResponse|string
     */
    public function getImage(string $name, string $driver = Image::DRIVER_LOCAL, string $type = 'model') : JsonResponse|string
    {
        if ($driver === Image::DRIVER_LOCAL) {
            if (Auth::check() && Auth::user()->can(strtolower($this->modelNameFromString($name)) . '.show')) {
                return $this->fetchImage($name, $driver, $type);
            } else {
                return abort(403);
            }
        } else {
            return $this->fetchImage($name, $driver, $type);
        }
    }

    /**
     * @param string $name
     * @param string $type
     * @param string $driver
     * @return JsonResponse
     */
    public function deleteSingleImage(string $name, string $type, string $driver) : JsonResponse
    {

        if (Auth::user()->can(strtolower($this->modelNameFromString($name)) . '.image')) {
            $path = $this->path($name, $type);
            if ($driver === Image::DRIVER_LOCAL) {
                if (Storage::disk(Image::DRIVER_LOCAL)->exists($path)) {
                    if (Storage::disk(Image::DRIVER_LOCAL)->delete($path)) {
                        return Response()->ok(__('general.deletedSuccessfully', ['id' => $name]));
                    }
                }
            } else {
                if (Storage::disk(Image::DRIVER_PUBLIC)->exists($path)) {
                    if (Storage::disk(Image::DRIVER_PUBLIC)->delete($path)) {
                        return Response()->ok(__('general.deletedSuccessfully', ['id' => $name]));
                    }
                }
            }
            return abort(404);
        } else {
            return abort(403);
        }
    }

    /**
     * @param string $name
     * @param string $driver
     * @param string $type
     * @return string|null
     */
    private function fetchImage(string $name, string $driver, string $type) : null|string
    {
        $path = $this->path($name, $type);
        if (Storage::disk($driver)->exists($path)) {
            return Storage::disk($driver)->get($path);
        }

        return abort(404);
    }

    /**
     * @param string $name
     * @param string $type
     * @return string|bool
     */
    private function path(string $name, string $type) : string|bool
    {
        if ($type === 'model') {
            $explode = explode('-', $name);
            $modelName = $explode[0] ?? '';
            $id = $explode[1] ?? '';
            return 'models/' . $modelName . '/' . $modelName . $id . '/' . $name;
        }

        return false;
    }

    /**
     * @param Model $model
     * @return string
     */
    private function directory(Model $model) : string
    {
        $modelName = $this->modelName($model);
        return 'models/' . $modelName . '/' . $modelName . $model->id;
    }

    /**
     * @param Model $model
     * @return string
     */
    private function modelName(Model $model) : string
    {
        return class_basename($model);
    }

    /**
     * @param string $name
     * @return string
     */
    private function modelNameFromString(string $name) : string
    {
        $explode = explode('-', $name);
        return $explode[0] ?? '';
    }

    /**
     * @param array $files
     * @return array
     */
    private function fileNames(array $files = []) : array
    {
        $names = [];
        foreach ($files as $file) {
            $explode = explode('/', $file);
            $names[] = end($explode);
        }

        return $names;
    }
}
