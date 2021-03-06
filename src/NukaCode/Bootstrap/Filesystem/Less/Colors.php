<?php namespace NukaCode\Bootstrap\Filesystem\Less;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Validation\Factory;
use NukaCode\Core\Filesystem\Core;

class Colors extends Core {

    protected $file;

    protected $validator;

    protected $less;

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
	 * @param Filesystem $file
	 * @param Factory    $validator
	 */
	public function __construct(Filesystem $file, Factory $validator)
    {
        $this->file      = $file;
        $this->validator = $validator;
        $this->less      = base_path('resources/assets/less/colors.less');
    }

	/**
	 * Update the colors.less file to persist the changes
	 *
	 * @param $package
	 */
	public function updateEntry($package)
    {
        $this->verifyCommand($package);

        $lines = file($this->less);

        // Set the new colors
        $lines[0] = '@bg:                '. $package['bg'] .";\n";
        $lines[1] = '@gray:              '. $package['gray'] .";\n";
        $lines[2] = '@brand-primary:     '. $package['primary'] .";\n";
        $lines[3] = '@brand-info:        '. $package['info'] .";\n";
        $lines[4] = '@brand-success:     '. $package['success'] .";\n";
        $lines[5] = '@brand-warning:     '. $package['warning'] .";\n";
        $lines[6] = '@brand-danger:      '. $package['danger'] .";\n";
        $lines[7] = '@menuColor:         '. $package['menu'] .";\n";

        $this->file->delete($this->less);
        $this->file->put($this->less, implode($lines));
    }

	/**
	 * Return the current color values for the site
	 *
	 * @return array
	 */
	public function getEntry()
    {
        $lines = file($this->less);

        $colors = [];

        $colors['bg']      = array('title' => 'Background Color',          'hex' => trim(substr(explode('@bg: ',               $lines[0])[1], 0, -2)));
        $colors['gray']    = array('title' => 'Main Gray',                 'hex' => trim(substr(explode('@gray: ',             $lines[1])[1], 0, -2)));
        $colors['primary'] = array('title' => 'Primary Color',             'hex' => trim(substr(explode('@brand-primary: ',    $lines[2])[1], 0, -2)));
        $colors['info']    = array('title' => 'Information Color',         'hex' => trim(substr(explode('@brand-info: ',       $lines[3])[1], 0, -2)));
        $colors['success'] = array('title' => 'Success Color',             'hex' => trim(substr(explode('@brand-success: ',    $lines[4])[1], 0, -2)));
        $colors['warning'] = array('title' => 'Warning Color',             'hex' => trim(substr(explode('@brand-warning: ',    $lines[5])[1], 0, -2)));
        $colors['danger']  = array('title' => 'Error Color',               'hex' => trim(substr(explode('@brand-danger: ',     $lines[6])[1], 0, -2)));
        $colors['menu']    = array('title' => 'Active Menu Link Color',    'hex' => trim(substr(explode('@menuColor: ',        $lines[7])[1], 0, -2)));

        return $colors;
    }
}