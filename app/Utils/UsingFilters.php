<?php

namespace MixCode\Utils;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UsingFilters
{
    protected $filterKeys = [
        'country',
        'city',
        'categories',
        'date_from',
        'date_to',
        'price_from',
        'price_to',
        'price_low',
        'price_high',
        'most_popular',
        'most_recently',
    ];

    /**
     * Scoped Filter Implementation
     *
     * @param Builder $builder
     * @param Request $request
     * @return Builder
     */
    public function scopeFilter(Builder $builder, Request $request)
    {
        $filters = $this->generateFilterMethods($request->keys());

        $filters->each(function ($filter) use($request, $builder) {
            $this->{$filter}($request, $builder);
        });

        return $builder;
    }

    /**
     * Filter cards by Country id
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByCountry(Request $request, Builder $builder)
    {
        if ($request->has('country') && $request->filled('country')) {
            $builder->where('country_id', $request->country);
        }

        return $builder;
    }

    /**
     * Filter cards by City id
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByCity(Request $request, Builder $builder)
    {
        if ($request->has('city') && $request->filled('city')) {
            $builder->where('city_id', $request->city);
        }

        return $builder;
    }

    /**
     * Filter cards by Categories Ids
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByCategories(Request $request, Builder $builder)
    {
        if ($request->has('categories') && $request->filled('categories')) {
            $builder->whereHas('categories', function (Builder $b) use ($request) {
                $b->whereIn('categories.id', $request->categories);
            });
        }

        return $builder;
    }

    
    /**
     * Filter cards by Date From (start date)
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByDateFrom(Request $request, Builder $builder)
    {
        if ($request->has('date_from') && $request->filled('date_from')) {
            $builder->whereDate('date_from', '>=', $request->date_from);
        }

        return $builder;
    }
 
    /**
     * Filter cards by Date To (end date)
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByDateTo(Request $request, Builder $builder)
    {
        
        if ($request->has('date_to') && $request->filled('date_to')) {
            $builder->whereDate('date_to', '<=', $request->date_to);
        }

        return $builder;
    }
 
    /**
     * Filter cards by Price From (start price)
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByPriceFrom(Request $request, Builder $builder)
    { 
        if ($request->has('price_from') && $request->filled('price_from')) {
            $builder->where('price', '>=', floatval($request->price_from));
        }

        return $builder;
    }
 
    /**
     * Filter cards by Price From (end price)
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByPriceTo(Request $request, Builder $builder)
    {
        if ($request->has('price_to') && $request->filled('price_to')) {
            $builder->where('price', '<=', $request->price_to);
        }   

        return $builder;
    }
 
    /**
     * Filter cards by lower price
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByPriceLow(Request $request, Builder $builder)
    {
        if ($request->has('price_low')) {
            // $builder->oldest('price');
            $builder->orderBy('price', 'asc'); // Used For More Readability
        }

        return $builder;
    }
 
    /**
     * Filter cards by higher price
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByPriceHigh(Request $request, Builder $builder)
    {
        if ($request->has('price_high')) {
            // $builder->latest('price'); 
            $builder->orderByDesc('price'); // Used For More Readability
        }

        return $builder;
    }
 
    /**
     * Filter cards by most popular
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByMostPopular(Request $request, Builder $builder)
    {
        if ($request->has('most_popular')) {
            // $builder->latest('views_count');
            $builder->orderByDesc('views_count'); // Used For More Readability
        }   

        return $builder;
    }
    
    /**
     * Filter cards by most recently (just created)
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByMostRecently(Request $request, Builder $builder)
    {
        if ($request->has('most_recently')) {
            // created_at is the default for ordering but for more readability i wrote it.
            $builder->latest('created_at'); 
        }

        return $builder;
    }
    
    /**
     * Generate filter methods names from request input keys
     *
     * @param array $keys
     * @return array
     */
    protected function generateFilterMethods(array $keys)
    {
        return collect($keys)->map(function ($key) {
            throw_unless(in_array($key, $this->filterKeys), New \Exception("Unknown filter called {$key}"));
            
            return 'filterBy' . Str::studly($key);
        });
    }
}