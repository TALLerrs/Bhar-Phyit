<?php

namespace Tallerrs\BharPhyit;

use Livewire\Livewire;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Tallerrs\BharPhyit\Console\ClearBharPhyit;
use Tallerrs\BharPhyit\Console\InstallBharPhyit;
use Tallerrs\BharPhyit\Http\Livewire\Components\ThemeBtn;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\View\Compilers\BladeCompiler;
use Tallerrs\BharPhyit\Http\Livewire\BharPhyit as LivewireBharPhyit;
use Tallerrs\BharPhyit\Http\Livewire\BharPhyitDetail as LivewireBharPhyitDetail;

class BharPhyitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->registerConfig();
        $this->registerDateFormat();
        $this->offerPublishing();
        $this->registerCommands();

        /**
         * livewire component register
         */
        Livewire::component('theme-btn', ThemeBtn::class);
        Livewire::component('bhar-phyit', LivewireBharPhyit::class);
        Livewire::component('bhar-phyit-detail', LivewireBharPhyitDetail::class);

        Blade::directive('formatSql', function ($expression) {
            return "<?php echo \\Tallerrs\\BharPhyit\\BharPhyitServiceProvider::formatSql($expression); ?>";
        });
    }

    public function register()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Tallerrs\BharPhyit\Handler\BharPhyitHandler::class
        );

        $this->callAfterResolving('blade.compiler', function (BladeCompiler $blade) {
            $blade->anonymousComponentPath(__DIR__.'/../resources/views/components/layouts', 'bhar-phyit-layout');
            $blade->anonymousComponentPath(__DIR__.'/../resources/views/components/icons', 'bhar-phyit-icon');
            $blade->anonymousComponentPath(__DIR__.'/../resources/views/components', 'bhar-phyit');
        });
    }

    /**
     * Register the BharPhyit routes.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        Route::group([
            // 'namespace' => 'Tallerrs\BharPhyit\Http\Controllers',
            'middleware' => config('bhar-phyit.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register the BharPhyit resources.
     *
     * @return void
     */
    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bhar-phyit');
    }

    /**
     * Register the BharPhyit migrations.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the BharPhyit config.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/bhar-phyit.php' => config_path('bhar-phyit.php'),
        ]);
    }

    /**
     * Register the BharPhyit Carbon macro.
     *
     * @return void
     */
    protected function registerDateFormat()
    {
        Carbon::macro('dtString', function () {
            return $this->format('Y-m-d g:i A');
        });
    }

    /**
     * Setup the resource publishing groups for BharPhyit.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../stubs/BharPhyitServiceProvider.stub' => app_path('Providers/BharPhyitServiceProvider.php'),
            ], 'bhar-phyit-provider');

            $this->publishes([
                __DIR__ . '/../config/bhar-phyit.php' => config_path('bhar-phyit.php'),
            ], 'bhar-phyit-config');
        }
    }

    /**
     * Register the BharPhyit Artisan commands.
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearBharPhyit::class,
                InstallBharPhyit::class,
            ]);
        }
    }

    /**
     * Format SQL query for display.
     *
     * @param string $sql
     * @return string
     */
    public static function formatSql($sql)
    {
        // Your logic to format the SQL query goes here
        // You can use regular expressions, string manipulation, or any other method

        // For example, you can add newlines and indentation for better readability
        $formattedSql = preg_replace("/(\bINSERT\b|\bVALUES\b|\bINTO\b|\b\(\b|\b\)\b|\bUPDATE\b|\bSET\b)/", "\n$1", $sql);

        return $formattedSql;
    }
}
