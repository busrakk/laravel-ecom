<?php

namespace App\Providers;

use App\Interfaces\Repository\CategoryRepository;
use App\Repositories\CategoryRepositoryEloquent;
use App\Interfaces\Repository\BrandRepository;
use App\Repositories\BrandRepositoryEloquent;
use App\Interfaces\Repository\ProductRepository;
use App\Repositories\ProductRepositoryEloquent;
use App\Interfaces\Repository\CartRepository;
use App\Repositories\CartRepositoryEloquent;
use App\Interfaces\Repository\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(CartRepository::class, CartRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
