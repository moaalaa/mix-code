<?php

namespace MixCode\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Schema::defaultStringLength(191);

        // view()->composer('write_path_here', function ($view) {
            
        //     $model = cache()->rememberForever('cache_name', function () {
        //         return Model::oldest()->get();
        //     });

        //     $view->with('model', $model);
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
