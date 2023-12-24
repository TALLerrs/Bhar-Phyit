<?php

namespace Tallerrs\BharPhyit;

use Illuminate\Support\ServiceProvider;

class  BharPhyitServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Tallerrs\BharPhyit\Exceptions\Handler::class,
        );
    }
}
