<?php namespace NukaCode\Bootstrap\Filesystem\Config;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Validation\Factory;
use NukaCode\Bootstrap\Filesystem\Less\Colors;
use NukaCode\Core\Database\Collection;
use NukaCode\Core\Filesystem\Core;

class Theme extends Core {

	protected $file;

	protected $validator;

	protected $config;

	protected $rules = [
		'bg'      => 'required',
		'gray'    => 'required',
		'primary' => 'required',
		'success' => 'required',
		'info'    => 'required',
		'warning' => 'required',
		'danger'  => 'required',
		'menu'    => 'required',
	];

	/**
	 * @var Colors
	 */
	private $colors;

	/**
	 * @param Filesystem $file
	 * @param Factory    $validator
	 */
	public function __construct(Filesystem $file, Factory $validator, Colors $colors)
	{
		$this->file      = $file;
		$this->validator = $validator;
		$this->config    = base_path('config/theme.php');
		$this->colors    = $colors;
	}

	public function refreshConfig()
	{
		// Update the color details
		$details = $this->colors->getEntry();

		$this->updateEntry($details);

		$this->updateTheme();
	}

	/**
	 * Update the config with the color values for easy retrieval
	 *
	 * @param $package
	 */
	public function updateEntry($package)
	{
		$this->verifyCommand($package);

		$lines = file($this->config);

		// Set the new colors
		$lines[27] = "        'bg'      => '" . $package['bg']['hex'] . "',\n";
		$lines[28] = "        'gray'    => '" . $package['gray']['hex'] . "',\n";
		$lines[29] = "        'primary' => '" . $package['primary']['hex'] . "',\n";
		$lines[30] = "        'info'    => '" . $package['info']['hex'] . "',\n";
		$lines[31] = "        'success' => '" . $package['success']['hex'] . "',\n";
		$lines[32] = "        'warning' => '" . $package['warning']['hex'] . "',\n";
		$lines[33] = "        'danger'  => '" . $package['danger']['hex'] . "',\n";
		$lines[34] = "        'menu'    => '" . $package['menu']['hex'] . "',\n";

		$this->file->delete($this->config);
		$this->file->put($this->config, implode($lines));
	}

	public function updateTheme()
	{
		// Update the theme
		$bower = new Collection(json_decode($this->file->get(base_path('/bower.json')))->dependencies);
		$bower = new Collection($bower->keys());

		ppd($bower->filter(null));

		$themes = $bower->filter(function ($package) {
			return stripos($package, 'nukacode-bootstrap-') !== false;
		});

		if ($themes->count() == 1) {
			$this->updateThemeEntry($themes->first());
		} elseif ($themes->count() > 1) {
			// See which theme is being used
			$lines = file(base_path('resources/assets/less/app.less'));

			$theme = $themes->filter(function ($theme) use ($lines) {
				return strpos($lines[0], $theme) !== false;
			})->first();

			$this->updateThemeEntry($theme);
		}
	}

	public function updateThemeEntry($theme)
	{
		$lines = file($this->config);

		$lines[16] = "    'theme' => '" . $theme . "',\n";

		$this->file->delete($this->config);
		$this->file->put($this->config, implode($lines));
	}
}