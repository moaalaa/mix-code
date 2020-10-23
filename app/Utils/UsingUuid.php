<?php

namespace MixCode\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UsingUuid
{
    protected static function bootUsingUuid()
    {
        static::creating(function(Model $model) {
            // Make The Id Equal The Generated Uuid
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}