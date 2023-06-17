<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Service\CategoryContact;
use App\Interfaces\Service\ProductContact;
use App\Interfaces\Service\BrandContact;
use App\Interfaces\Service\CartContact;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\BrandService;
use App\Services\CartService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryContact::class , CategoryService::class);
        $this->app->bind(ProductContact::class , ProductService::class);
        $this->app->bind(BrandContact::class , BrandService::class);
        $this->app->bind(CartContact::class , CartService::class);
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
