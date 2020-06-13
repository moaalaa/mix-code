<?php

namespace MixCode\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use MixCode\Favorite;

trait UsingFavorite 
{
    protected static function bootUsingFavorite()
    {
        // When Deleting Model
        static::deleting(function (Model $model) {
            $model->favorites->each->delete();

            /*
                the line above equal the next line
                $model->favorites->each(function ($favorite) {
                    $favorite->delete();
                });
            */
        });
    }

    /**
     * Undocumented function
     *
     * @return MorphMany
     */
    public function favorites()
    {
        // NOTE: Second Argument is favorited_id 
        // but the function need it with out "_id" prefix 
        // so we put it like this favorited

        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Mark Model as Favorite
     *
     * @return \MixCode\Favorite
     */
    public function markAsFavorite()
    {
        $user_id = ['user_id' => auth()->id()];
        
        if ($this->isFavorited()) return;
        
        return $this->favorites()->create($user_id);
    }

    /**
     * Mark Favorite Model as Un Favorite
     *
     * @return $this
     */
    public function markAsUnFavorite()
    {
        $this->favorites()->where('user_id', auth()->id())->delete();
        
        return $this;
    }

    /**
     * Check if Model is Favorite or Not
     * 
     * @return bool
     */
    public function isFavorited()
    {
        $userId = auth()->id();

        // Reuse User with "api" guard in api
        // Reason for that is "list all cards" endpoint don't require use to be authenticated
        // so if we pass the Bearer Token, it will not work
        // Because we don't use "auth:api" that is using "api" guard for us
        // So We Need to use "api" Guard manually
        if (request()->wantsJson()) {
            $userId = auth('api')->id();
        }
        
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
}
