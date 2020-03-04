<?php

namespace OmeneJoseph\Scafolder;

use Illuminate\Support\ServiceProvider;
use OmeneJoseph\Scafolder\Commands\CreateRepositoryCommand;
use OmeneJoseph\Scafolder\Commands\CreateTraitCommand;

class ScafolderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'omenejoseph');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'omenejoseph');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/scafolder.php', 'scafolder');

        // Register the service the package provides.
        $this->app->singleton('scafolder', function ($app) {
            return new Scafolder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['scafolder'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/scafolder.php' => config_path('scafolder.php'),
        ], 'scafolder.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/omenejoseph'),
        ], 'scafolder.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/omenejoseph'),
        ], 'scafolder.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/omenejoseph'),
        ], 'scafolder.views');*/

        // Registering package commands.
         $this->commands([CreateRepositoryCommand::class, CreateTraitCommand::class]);
    }
}
