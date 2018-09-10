<?php
/**
 * @author namtd
 */
namespace App\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use App\Backend\Services\Interfaces;
use App\Backend\Services\Production;
class PropServiceProvider extends ServiceProvider
{
    protected $services = [
        Interfaces\PropServiceInterface::class=>Production\PropService::class,
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register services
        foreach ($this->services as $inteface => $service) {
            $this->app->singleton($inteface, $service);
        }
    }
}
