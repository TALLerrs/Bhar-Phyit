<?php

namespace Tallerrs\BharPhyit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallBharPhyit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:bhar-phyit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the BharPhyit resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing BharPhyit Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'bhar-phyit-provider']);

        $this->comment('Publishing BharPhyit Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'bhar-phyit-config']);

        $this->registerHorizonServiceProvider();

        $this->info('BharPhyit scaffolding installed successfully.');
    }

    /**
     * Register the BharPhyit service provider in the application configuration file.
     *
     * @return void
     */
    protected function registerBharPhyitServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace . '\\Providers\\BharPhyitServiceProvider::class')) {
            return;
        }

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\EventServiceProvider::class," . PHP_EOL,
            "{$namespace}\\Providers\EventServiceProvider::class," . PHP_EOL . "        {$namespace}\Providers\BharPhyitServiceProvider::class," . PHP_EOL,
            $appConfig
        ));

        file_put_contents(app_path('Providers/BharPhyitServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/BharPhyitServiceProvider.php'))
        ));
    }
}
