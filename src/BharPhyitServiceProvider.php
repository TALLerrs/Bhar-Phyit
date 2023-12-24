<?php

namespace Tallerrs\BharPhyit;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Tallerrs\BharPhyit\Exceptions\Handler;

class  BharPhyitServiceProvider extends ServiceProvider
{
    public function register()
    {
        if($this->app['log'] instanceof \Illuminate\Log\LogManager) {
            $this->app['log']->extend('bhar-phyit', function ($app, $config) {
                $handler = new Handler(); 

                return new Logger('bhar-phyit', [$handler]);
            });
        }
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // $this->app->singleton(
        //     \Tallerrs\BharPhyit\Exceptions\Handler::class,
        // );
    }
}
