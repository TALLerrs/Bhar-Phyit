<?php

namespace Tallerrs\BharPhyit;

use Illuminate\Support\ServiceProvider;
use Tallerrs\BharPhyit\Exceptions\BharPhyitHandler;
use Tallerrs\BharPhyit\Console\ClearBharPhyit;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Route;

class  BharPhyitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(ExceptionHandler::class, BharPhyitHandler::class);
        $this->registerCommands();
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->registerConfig();
        // $this->registerStyleResource();
    }

    public function register()
    {
        // $this->app->singleton(ErrorHandler::class, function ($app) {
        //     return new ErrorHandler($app);
        // });

        $this->app->bind(ExceptionHandler::class, BharPhyitHandler::class);
    }

    protected function registerCommands(): void
    {
        $this->commands([
            ClearBharPhyit::class,
        ]);
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bhar-phyit');
    }

    // protected function registerStyleResource(): void
    // {
    //     $this->loadViewsFrom(__DIR__ . '/../resources/assets/css/app.css', 'bhar-phyit-style');
    // }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/bhar-phyit.php' => config_path('bhar-phyit.php'),
        ]);
    }
}
