<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Services\newsServiceInterface', 'App\Services\newsService');
        $this->app->bind('App\Contracts\Dao\newsDaoInterface','App\Dao\newsDao');
        $this->app->bind('App\Contracts\Services\productServiceInterface', 'App\Services\productService');
        $this->app->bind('App\Contracts\Dao\productDaoInterface','App\Dao\productDao');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface','App\Dao\UserDao');
        $this->app->bind('App\Contracts\Services\UserServiceInterface','App\Services\UserService');
        $this->app->bind('App\Contracts\Services\orderServiceInterface', 'App\Services\orderService');
        $this->app->bind('App\Contracts\Dao\orderDaoInterface','App\Dao\orderDao');
        $this->app->bind('App\Contracts\Services\orderDetailServiceInterface', 'App\Services\orderDetailService');
        $this->app->bind('App\Contracts\Dao\orderDetailDaoInterface','App\Dao\orderDetailDao');
        $this->app->bind('App\Contracts\Services\wishlistServiceInterface', 'App\Services\wishlistService');
        $this->app->bind('App\Contracts\Dao\wishlistDaoInterface','App\Dao\wishlistDao');
      
    
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
