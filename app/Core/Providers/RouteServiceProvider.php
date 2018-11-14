<?php

namespace App\Core\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    protected $namespace = 'App\Core\Http\Controllers';
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
        $this->mapAdminRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

}
