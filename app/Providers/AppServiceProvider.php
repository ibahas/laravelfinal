<?php

namespace App\Providers;

use App\Repositories\OrdersInterface;
use App\Repositories\OrdersRepository;
use App\Repositories\ProductsInterface;
use App\Repositories\ProductsRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ProductsInterface::class, ProductsRepository::class);
        $this->app->bind(OrdersInterface::class, OrdersRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerPolicies();
        Passport::routes();
    }
}
