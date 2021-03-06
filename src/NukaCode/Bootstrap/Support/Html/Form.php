<?php namespace NukaCode\Bootstrap\Support\Html;

use Illuminate\Support\Facades\Facade;

class Form extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'bootstrap-form'; }

}
