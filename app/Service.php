<?php


namespace MixCode;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use MixCode\Utils\RefreshCache;
 use MixCode\Utils\UsingApiScopes;
use MixCode\Utils\UsingFilters;
use MixCode\Utils\UsingMedia;
use MixCode\Utils\UsingUuid;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Service extends Model implements HasMedia
{
    use UsingUuid, 
    UsingMedia, 
    UsingApiScopes, 
    UsingFilters, 
    HasMediaTrait, 
    RefreshCache, 
    SoftDeletes;

 
   const CREATOR_RELATION_KEY = 'creator_id';
    
   protected $appends = [
       'name_by_lang', 
       'overview_by_lang', 
        'media_links', 
    ];
   
   protected $with = ['media'];

   protected $fillable = [
    'en_name',
    'ar_name',
    'ar_overview',
    'en_overview',
    'creator_id'

];

protected $hidden = [
    'en_name', 
    'ar_name', 
      'media'
];

protected static function boot()
{
    parent::boot();

    // When Deleting Service
    static::deleting(function (Service $service) {
        // Clear Service Views Relation
        $service->views()->detach();

        // Clear Service Views Field
        $service->views_count = 0;
        $service->save();
    });
}

public function path()
{
    return route('dashboard.services.show', $this);
}

public function apiPath()
{
    return route('api.services.show', $this);
}

public function viewPath()
{
    return route('services.show', $this);
}

 

public function creator()
{
    return $this->belongsTo(User::class, static::CREATOR_RELATION_KEY)->withoutGlobalScopes();
}

 

/**
 * Create New services With It's Relations
 *
 * @param Request $request
 * @return void
 */
public function createNewService($request)
{
    $service = static::create($request->all()); 
    return $service;
}

/**
 * Update services With It's Relations
 *
 * @param Request $request
 * @return void
 */
public function updateService($request)
{
    static::update($request->all());


    return $this;
}
 
 

public function getMediaLinksAttribute()
{
    $media = $this->allMedia();

    $links = $media->map(function ($m){
        return $this->safeMediaUrl($m->getUrl());
    });
    
    return $links;
}

public function getNameByLangAttribute()
{
    $lang = app()->getLocale();

    if (request()->wantsJson()) {
        $lang = $this->hasLang();
    }
    
    $field = $lang . '_name';

    return $this->{$field};
}

public function getOverviewByLangAttribute()
{
    $lang = app()->getLocale();
    $clean = false;

    if (request()->wantsJson()) {
        $lang = $this->hasLang();
        $clean = true;
    }
    
    $field = $lang . '_overview';
    
    $field = $this->{$field};

    return $clean ? shortCleanString($field, $limit = null) : $field;
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


}

  

