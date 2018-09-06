<?php
/**
 * @author thanhnv
 */
namespace App\Dev\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dev\Services\Interfaces;
use App\Dev\Services\Production;
class DevServiceProvider extends ServiceProvider
{
    protected $services = [
        Interfaces\DevServiceInterface::class => Production\DevService::class,
        Interfaces\TranslateServiceInterface::class=>Production\TranslationService::class,
        Interfaces\AclServiceInterface::class=>Production\AclService::class,
        Interfaces\CategoryServiceInterface::class=>Production\CaterogyService::class,
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
