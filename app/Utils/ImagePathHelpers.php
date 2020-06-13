<?php

namespace MixCode\Utils;

use Illuminate\Support\Facades\Storage;


trait ImagePathHelpers
{

    protected static function bootImagePathHelpers()
    {
        static::deleting(function ($model) {
            $model->deleteImage();
        });
    }
    
    /**
     * Determine If The Image Of The Model Is Exists And Return It
     * Otherwise It WillReturn Default Image 
     *
     * @return string
     */
    public function getImagePathAttribute()
    {
        if ($this->imageExists()) {
            return asset("storage/{$this->image}");
        }

        return 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
    }

    /**
     * Determine If The Image Exists In The Storage
     *
     * @param string $image
     * @return bool
     */
    protected function imageExists($image = null)
    {
        return Storage::exists($image ?? $this->image);
    }

    /**
     * Delete Image From The Storage
     *
     * @param string $image
     * @return bool
     */
    protected function deleteImage($image = null)
    {
        return Storage::delete($image ?? $this->image);
    }
}
