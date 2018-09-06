<?php
/**
 * @author thanhnv
 */
namespace App\Acl\Providers;

use Illuminate\Support\ServiceProvider;
use App\Acl\Services\Interfaces;
use App\Acl\Services\Production;
class AclServiceProvider extends ServiceProvider
{
    protected $services = [
        Interfaces\AclServiceInterface::class => Production\AclService::class,
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
