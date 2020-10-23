<?php

namespace MixCode\Utils;

use Illuminate\Database\Eloquent\Builder;

trait UsingApiScopes
{
    protected static function bootUsingApiScopes()
    {
        if (request()->wantsJson()) {

            // Relations Scopes
            static::relationsScopes();

            // Orders Scopes
            static::orderScopes();
        }

    }

    /**
     * Relations Scopes Declarations
     *
     * @return void
     */
    protected static function relationsScopes()
    {
        $withRelations = (request()->has('with') && request()->filled('with'));
            
        if ($withRelations) {
            static::addGlobalScope('with_relations', function (Builder $builder) {
                $builder->with(explode(',', request('with')));
            });
        }   

        $withCountRelations = (request()->has('with_count') && request()->filled('with_count'));
        
        if ($withCountRelations) {
            static::addGlobalScope('with_count_relations', function (Builder $builder) {
                $builder->withCount(explode(',', request('with_count')));
            });
        }       
    }

    /**
     * Order Scopes Declarations
     *
     * @return void
     */
    protected static function orderScopes()
    {
        
        // EX: order_by_asc=id
        $order_by_ascending = (request()->has('order_by_asc') && request()->filled('order_by_asc'));
        
        if ($order_by_ascending) {
            static::addGlobalScope('order_by_asc', function (Builder $builder) {
                $builder->oldest(request('order_by_asc'));
            });
        }   

        // EX: order_by_desc=id
        $order_by_descending = (request()->has('order_by_desc') && request()->filled('order_by_desc'));
        
        if ($order_by_descending) {
            static::addGlobalScope('order_by_desc', function (Builder $builder) {
                $builder->latest(request('order_by_desc'));
            });
        }   

    
    }
}