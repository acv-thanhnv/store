<?php

namespace App\Dev\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Dev\Http\Controllers';

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
        if(Config::get('app.DEV_MODE')==true){
            $this->mapDevRoutes();
        }
    }

    /**
     * Define the "dev" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDevRoutes()
    {
        if(file_exists (base_path('routes/dev.php'))){
            Route::middleware('dev')
                ->namespace($this->namespace)
                ->group(base_path('routes/dev.php'));
        }
    }

}
