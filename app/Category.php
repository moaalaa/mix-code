<?php

namespace MixCode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MixCode\Utils\RefreshCache;
use MixCode\Utils\UsingApiScopes;
use MixCode\Utils\UsingMedia;
use MixCode\Utils\UsingStatus;
use MixCode\Utils\UsingUuid;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Category extends Model implements HasMedia
{
    use UsingUuid, UsingStatus, HasMediaTrait, UsingMedia, UsingApiScopes, RefreshCache, SoftDeletes;

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'disable';

    const CREATOR_RELATION_KEY = 'creator_id';

    /**
     * The attributes that should be appended.
     *
     * @var array
     */
    protected $appends = ['name_by_lang', 'icon'];
    protected $with = ['media'];

    protected $fillable = [
        'en_name',
        'ar_name',
        'status',
        'creator_id',
    ];

    protected $hidden = ['media'];

    public function path()
    {
        return route('dashboard.categories.show', $this);
    }

    public function apiPath()
    {
        return route('api.categories.show', $this);
    }
    
    public function viewPath()
    {
        return route('categories.show', $this);
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, static::CREATOR_RELATION_KEY)->withoutGlobalScopes();
    }
    
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_categories', 'category_id', 'card_id')
            ->using(CardCategory::class)
            ->withoutGlobalScopes();
    }
    
    public function getNameByLangAttribute()
    {
        $field = $this->getLang() . '_name';

        return $this->{$field};
    }

    /**
     * Return lang key based on if request wants json response for api
     *
     * @return string
     */
    protected function getLang()
    {
        return request()->wantsJson() ? $this->hasLang() : app()->getLocale();
    }

    /**
     * return lang key if exists in request or fall back to "en"
     *
     * @return string
     */
    protected function hasLang() 
    {
        return (request()->has('lang') && request()->filled('lang')) ? request('lang') : 'en';
    }

    public function getIconAttribute()
    {
        return $this->safeMediaUrl($this->mainMediaUrl('icon'));
    }
}
