<?php
/**
 * @author thanhnv
 */
namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;
use App\Api\V1\Services\Interfaces;
use App\Api\V1\Services\Production;
class ApiServiceProvider extends ServiceProvider
{
    protected $services = [
        Interfaces\FoodServiceInterface ::class => Production\FoodService ::class,
        Interfaces\OrderServiceInterface ::class => Production\OrderService ::class,
        Interfaces\KitchenServiceInterface ::class => Production\KitchenService ::class,
        Interfaces\CashierServiceInterface ::class => Production\CashierService ::class,
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
