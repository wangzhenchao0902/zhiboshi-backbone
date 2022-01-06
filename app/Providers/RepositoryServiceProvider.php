<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Manager\Repositories\ManagerRepository;
use App\Models\Article\Repositories\ArticleRepository;
use App\Models\Anli\Repositories\AnliRepository;
use App\Models\Product\Repositories\ProductRepository;
use App\Models\Warranty\Repositories\WarrantyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ManagerRepository::class, ManagerRepository::class);
        $this->app->bind(ArticleRepository::class, ArticleRepository::class);
        $this->app->bind(AnliRepository::class, AnliRepository::class);
        $this->app->bind(ProductRepository::class, ProductRepository::class);
        $this->app->bind(WarrantyRepository::class, WarrantyRepository::class);
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
