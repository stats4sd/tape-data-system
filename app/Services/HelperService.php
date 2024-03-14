<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class HelperService
{
    public static function getModels(): Collection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                return sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    str_replace('/', '\\', substr($path, 0, strrpos($path, '.'))));
            })
            ->filter(function ($class) {
                $valid = false;

                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }

                return $valid;
            });

        return $models->values();
    }

    public static function getOdkVariablesToIgnore(): array
    {
        return [
            '__id',
            'instanceID',
            'meta',
            'deviceid',
            'start_time',
            'end_time',
            '_id',
            'uuid',
            '__version__',
            '_xform_id_string',
            '_uuid',
            '_attachments',
            '_status',
            '_geolocation',
            '_submission_time',
            '_tags',
            '_notes',
            '_validation_status',
            '_submitted_by',
        ];
    }
}
