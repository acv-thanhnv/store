<?php
/**
 * @author thanhnv
 */
namespace App\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use App\Backend\Services\Interfaces;
use App\Backend\Services\Production;
use App\Core\Services\Interfaces As CoreInterFace;
use App\Core\Services\Production As CoreProduction;
class BackendServiceProvider extends ServiceProvider
{
    protected $services = [
        CoreInterFace\UploadServiceInterface::class => CoreProduction\UploadService ::class,
        Interfaces\FoodServiceInterface::class=>Production\FoodService::class,
        Interfaces\StoreServiceInterface::class=>Production\StoreService::class,
        Interfaces\MenuServiceInterface::class=>Production\MenuService::class,
        Interfaces\TypeServiceInterface::class=>Production\TypeService::class,
        Interfaces\UserServiceInterface::class=>Production\UserService::class,
        Interfaces\OrderServiceInterface::class=>Production\OrderService::class,
        Interfaces\FloorServiceInterface::class=>Production\FloorService::class,
        Interfaces\TableServiceInterface::class=>Production\TableService::class,
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
