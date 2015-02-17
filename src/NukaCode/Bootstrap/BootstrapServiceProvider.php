<?php namespace NukaCode\Bootstrap;

use NukaCode\Core\BaseServiceProvider;

class BootstrapServiceProvider extends BaseServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    const version = '1.0.0';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->shareWithApp();
        $this->setPublishGroups();
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
     * Load the config for the package
     *
     * @return void
     */
    protected function setPublishGroups()
    {
        $this->publishes(
            [
                __DIR__ . '/../../config/config.php' => config_path('nukacode-frontend.php')
            ], 'config'
        );
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
            'HTML'   => 'NukaCode\Bootstrap\Support\Html\HTML',
            'Form'   => 'NukaCode\Bootstrap\Support\Html\Form',
            'BBCode' => 'NukaCode\Bootstrap\Support\Html\BBCode',
        ];

        $exclude = $this->app['config']->get('nukacode-frontend.excludeAliases');
        
        $this->loadAliases($aliases, $exclude);
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
        return ['bootstrap'];
    }

}
