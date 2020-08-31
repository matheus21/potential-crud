<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repository;
use App\Domain\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Service\DeveloperService::class, function($app) {
           return new Service\DeveloperService(
               $app->make(Repository\DeveloperRepository::class)
           );
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
