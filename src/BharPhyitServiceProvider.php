<?php

namespace Tallerrs\BharPhyit;

use Illuminate\Support\ServiceProvider;
use Tallerrs\BharPhyit\Exceptions\BharPhyitHandler;
use Tallerrs\BharPhyit\Console\ClearBharPhyit;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class  BharPhyitServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $this->app->singleton(ErrorHandler::class, function ($app) {
        //     return new ErrorHandler($app);
        // });
        
        $this->app->bind(ExceptionHandler::class, BharPhyitHandler::class);

        $this->commands([
            ClearBharPhyit::class,
        ]);
    }

    public function boot()
    {
        $this->app->bind(ExceptionHandler::class, BharPhyitHandler::class);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__.'/config/bhar-phyit.php' => config_path('bhar-phyit.php'),
        ]);
    }
}
