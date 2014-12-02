<?php namespace Silber\Templates;

use Illuminate\Support\ServiceProvider;

class TemplatesServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('silber/templates', null, __DIR__ . '/');

		$this->app->bindShared('Silber\Templates\Templates', function($app)
		{
			$views = $this->getViewsBasePath();

			$config = $this->app['config']->get('templates::config', []);

			return new Templates($views, $config);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['Silber\Templates\Templates'];
	}

	/**
	 * Get the base path to the views directory.
	 *
	 * @return string
	 */
	protected function getViewsBasePath()
	{
		$path = $this->app['config']->get('templates::views');

		if (is_null($path))
		{
			$path = $this->app['config']->get('view.paths.0', function()
			{
				return app_path('views');
			});
		}

		return realpath($path);
	}

}
