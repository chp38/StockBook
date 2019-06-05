<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\AlphaVantage\AlphaVantageInterface',
            'App\Repositories\AlphaVantage\AlphaVantageRepository'
        );

        /*
         * Decorator 
         * $this->app->bind('App\Repositories\AlphaVantage\AlphaVantageInterface', function () {
           $baseRepo = new \App\Repositories\AlphaVantage\AlphaVantageRepository();
           $cachingRepo = new \App\Repositories\AlphaVantage\CachingAlphaVantageRepository($baseRepo, $this->app['cache.store']);
           return $cachingRepo;
       });*/
    }
}
