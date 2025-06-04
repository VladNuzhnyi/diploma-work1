<?php

namespace App\Providers;

use App\Http\Logic\Services\AdService;
use App\Http\Logic\Services\RentService;
use App\Http\Logic\Services\UserService;
use Elasticsearch\ClientBuilder;
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
        $this->app->bind('App\Http\Logic\ServiceInterfaces\AdServiceInterface', function ($app) {
            return new AdService();
        });
        $this->app->bind("App\Http\Logic\ServiceInterfaces\RentServiceInterface", function(){
            return new RentService();
        });
        $this->app->bind("App\Http\Logic\ServiceInterfaces\UserServiceInterface", function (){
            return new UserService();
        });

        $this->app->bind("Elasticsearch\Client", function (){
            $elastic = ClientBuilder::create()
                ->setHosts(['elasticsearch:9200'])
                ->build();
            return $elastic;
        });

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
