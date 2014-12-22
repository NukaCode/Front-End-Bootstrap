<?php namespace NukaCode\Bootstrap\Controllers\Admin;

use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use NukaCode\Bootstrap\Http\Requests\Admin\Theme;
use NukaCode\Core\Controllers\AdminController;
use NukaCode\Core\Remote\SSH;
use NukaCode\Bootstrap\Remote\Theme as ConsoleTheme;
use NukaCode\Bootstrap\Filesystem\Config\Theme as ConfigTheme;
use NukaCode\Bootstrap\Filesystem\Less\Colors;
use NukaCode\Core\Ajax\Ajax;

class StyleController extends AdminController {

    private $ssh;

    private $theme;

    private $configTheme;

    private $colors;

    private $ajax;

    private $config;

    public function __construct(SSH $ssh, ConsoleTheme $theme, ConfigTheme $configTheme, Colors $colors, Ajax $ajax, Repository $config)
    {
        parent::__construct();

        $this->ssh         = $ssh;
        $this->theme       = $theme;
        $this->configTheme = $configTheme;
        $this->colors      = $colors;
        $this->ajax        = $ajax;
        $this->config      = $config;
    }

    public function index()
    {
        $laravelVersion = Application::VERSION;
        $packages = $this->config->get('packages.nukacode');

        $this->setViewData(compact('laravelVersion', 'packages'));
    }

    public function getTheme()
    {
        $colors = $this->colors->getEntry();

        $availableThemes = $this->config->get('theme.themes');
        $currentTheme    = $this->config->get('theme.theme.style');
        $currentSrc      = $this->config->get('theme.theme.src');

        $this->setViewData(compact('colors', 'availableThemes', 'currentTheme', 'currentSrc'));
    }

    public function postTheme(Theme $request)
    {
		// Update the colors less file
		$this->colors->updateEntry($request->all());

		// Update the config file
		$this->configTheme->updateEntry($request->all());

		// Generate the new theme css file
		$commands = $this->theme->generateTheme($request->get('style'), $request->get('src'));
		$this->ssh->runCommands($commands);

		return \Redirect::route('admin.style.index')->with('message', 'Theme updated.');
    }
} 