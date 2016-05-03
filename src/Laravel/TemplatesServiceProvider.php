<?php

namespace Silber\Templates\Laravel;

use Silber\Templates\Templates;
use Illuminate\Support\ServiceProvider;

class TemplatesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config.php' => config_path('templates.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config.php', 'templates');

        $this->app->singleton(Templates::class, function($app) {
            $views = $this->getViewsBasePath();

            $config = $this->app['config']->get('templates');

            return new Templates($views, $config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Templates::class];
    }

    /**
     * Get the base path to the views directory.
     *
     * @return string
     */
    protected function getViewsBasePath()
    {
        $path = $this->app['config']->get('templates.views');

        if (is_null($path)) {
            $path = $this->app['config']->get('view.paths.0');
        }

        if (is_null($path)) {
            $path = base_path('resources/views');
        }

        return realpath($path);
    }
}
