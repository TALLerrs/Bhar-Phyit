<?php

namespace Tallerrs\BharPhyit;

use Illuminate\Support\ServiceProvider;
use Tallerrs\BharPhyit\Console\ClearBharPhyit;

class  BharPhyitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerCommands();
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->registerConfig();
    }

    public function register()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Tallerrs\BharPhyit\Exceptions\BharPhyitHandler::class
        );
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
