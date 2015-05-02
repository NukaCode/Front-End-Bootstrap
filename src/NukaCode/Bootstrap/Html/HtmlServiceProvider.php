<?php namespace NukaCode\Bootstrap\Html;

use Illuminate\Html\FormBuilder as BaseForm;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHtmlBuilder();

        $this->registerFormBuilder();

		$this->registerBBCode();
    }

    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('bootstrap-html', function($app)
        {
            return $app->make('NukaCode\Bootstrap\Html\HtmlBuilder');
        });
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('bootstrap-form', function($app)
        {
            $form = new FormBuilder($app['bootstrap-html'], $app['url'], $app['session.store']->getToken(), $app['view']);

            return $form->setSessionStore($app['session.store']);
        });
    }

	/**
	 * Register the BBCode instance.
	 *
	 * @return void
	 */
	protected function registerBBCode()
	{
		$this->app->bindShared('bbcode', function($app)
		{
			return $app->make('NukaCode\Core\Html\BBCode');
		});
	}

}