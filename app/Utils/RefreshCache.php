<?php

namespace MixCode\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


trait RefreshCache
{
    protected static function bootRefreshCache()
    {
        static::saved(function (Model $model) {
            cache()->forget($model->cacheKey());
            
        });

        static::deleted(function (Model $model) {
            cache()->forget($model->cacheKey());
        });
    }

    protected function cacheKey()
    {
        return $this->getTable();
    }
}
