<?php namespace NukaCode\Bootstrap;

use Config;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use NukaCode\Core\Console\AppNameCommand;
use NukaCode\Core\Database\Collection;

class BootstrapServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	const version = '1.0.0';

	const packageName = 'bootstrap';

	const color = 'info';

	const icon = 'fa-twitter';

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//$this->package('nukacode/bootstrap');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->shareWithApp();
		$this->registerViews();
		$this->registerAliases();
		$this->registerArtisanCommands();
	}

	/**
	 * Share the package with application
	 *
	 * @return void
	 */
	protected function shareWithApp()
	{
		$this->app['bootstrap'] = $this->app->share(function ($app) {
			return true;
		});
	}

	/**
	 * Register views
	 *
	 * @return void
	 */
	protected function registerViews()
	{
		$this->app['view']->addLocation(__DIR__ . '/../../views');
	}

	/**
	 * Register aliases
	 *
	 * @return void
	 */
	protected function registerAliases()
	{
		$aliases = [
			// Facades
			'HTML'   => 'NukaCode\Bootstrap\Support\Facades\Html\HTML',
			'bForm'  => 'NukaCode\Bootstrap\Support\Facades\Html\bForm',
			'BBCode' => 'NukaCode\Bootstrap\Support\Facades\Html\BBCode',

		];

		$appAliases = Config::get('core::nonCoreAliases');
		$loader     = AliasLoader::getInstance();

		foreach ($aliases as $alias => $class) {
			if (! is_null($appAliases)) {
				if (! in_array($alias, $appAliases)) {
					$loader->alias($alias, $class);
				}
			} else {
				$loader->alias($alias, $class);
			}
		}

	}

	public function registerArtisanCommands()
	{
		$this->commands(
			[
				'NukaCode\Bootstrap\Console\ThemeCommand',
			]
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}