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

class Portfolio extends Model implements HasMedia
{
    use UsingUuid, 
    UsingMedia, 
    UsingApiScopes, 
    UsingFilters, 
    HasMediaTrait, 
    RefreshCache, 
    SoftDeletes;

 
   const CREATOR_RELATION_KEY = 'creator_id';
   
   const ACTIVE_STATUS = 'active';
   const INACTIVE_STATUS = 'disable'; 
   
    
   protected $appends = [

        'media_links', 
    ];
   
   protected $with = ['media','categories','client'];

   protected $fillable = [
    'client_id',
    'url',
    'status',
    'creator_id'

];

protected $hidden = [
   
      'media'
];

protected static function boot()
{
    parent::boot();

    // When Deleting portfolio
    static::deleting(function (Portfolio $portfolio) {
        // Clear portfolio Views Relation
        $portfolio->views()->detach();

        // Clear portfolio Views Field
        $portfolio->views_count = 0;
        $portfolio->save();
    });
}

public function path()
{
    return route('dashboard.portfolios.show', $this);
}

public function apiPath()
{
    return route('api.portfolios.show', $this);
}

public function viewPath()
{
    return route('portfolios.show', $this);
}

 

public function categories()
{
    return $this->belongsToMany(Category::class, 'portfolio_categories', 'portfolio_id', 'category_id')
        ->using(PortfolioCategory::class)
        ->withoutGlobalScopes();
}



public function views()
{
    return $this->belongsToMany(User::class, 'portfolio_views', 'portfolio_id', 'user_id')
        ->using(PortfolioView::class)
        ->withoutGlobalScopes();
}

public function reviews()
{
    return $this->hasMany(Review::class, 'portfolio_id');
}

public function client()
{
    return $this->belongsTo(Client::class, 'client_id')->withoutGlobalScopes();
}


public function creator()
{
    return $this->belongsTo(User::class, static::CREATOR_RELATION_KEY)->withoutGlobalScopes();
}

 

/**
 * Create New portfolios With It's Relations
 *
 * @param Request $request
 * @return void
 */
public function createNewPortfolio($request)
{
    $portfolio = static::create($request->all());

    $portfolio->categories()->attach($request->categories_id); 
    return $portfolio;
}

/**
 * Update portfolios With It's Relations
 *
 * @param Request $request
 * @return void
 */
public function updatePortfolio($request)
{
    static::update($request->all());

    $this->categories()->sync($request->categories_id);
    // $this->companies()->sync($request->companies_id);

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

  

