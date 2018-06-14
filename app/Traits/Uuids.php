<?php

namespace App;

use App\Models\BaseModel;
use Webpatser\Uuid\Uuid;

trait Uuids
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (BaseModel $model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}