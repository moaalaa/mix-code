<?php

namespace MixCode\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'MixCode\Http\Controllers';
    protected $apiNamespace = 'MixCode\Http\Controllers\Api';
    protected $dashboardNamespace = 'MixCode\Http\Controllers\Dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        
        $this->mapWebDashboardRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'language'])
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "dashboard" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebDashboardRoutes()
    {
        Route::middleware(['web', 'dashboard', 'language'])
             ->namespace($this->dashboardNamespace)
             ->name('dashboard.')
             ->prefix('dashboard')
             ->group(base_path('routes/dashboard.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->name('api.')
             ->namespace($this->apiNamespace)
             ->group(base_path('routes/api.php'));
    }
}
