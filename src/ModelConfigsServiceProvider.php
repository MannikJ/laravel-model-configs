<?php

namespace MannikJ\Laravel\ModelConfigs;

use Illuminate\Support\ServiceProvider;

class ModelConfigsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-model-configs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-model-configs');
        if (config('model-configs.autoload_migrations')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            if (config('rinvex.categories.autoload_migrations')) {
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/categories/');
            }
            if (config('versionable.autoload_migrations')) {
                $this->loadMigrationsFrom(__DIR__ . '/../vendor/mpociot/versionable/src/migrations/');
            }
        }
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('model-configs.php'),
            ], 'config');
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__ . '/../database/2019_05_20_000000_create_model_configs_tables.php' => database_path('migrations' . $timestamp . '_create_model_configs_tables.php')
            ], 'model-configs-migrations');

            // Publishing the views.,
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-model-configs'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-model-configs'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-model-configs'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'model-configs');
        $this->mergeConfigFrom(__DIR__ . '/../config/categories.php', 'rinvex.categories');
        $this->mergeConfigFrom(__DIR__ . '/../config/versionable.php', 'versionable');
        #
        // Register the main class to use with the facade
        $this->app->singleton('model-configs', function () {
            return new ModelConfigs;
        });
    }
}
