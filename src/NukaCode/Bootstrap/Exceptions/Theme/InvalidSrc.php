<?php namespace NukaCode\Bootstrap\Exceptions\Theme;


class InvalidSrc extends \Exception {

    public function __construct($src)
    {
        parent::__construct('Theme directory [' . $src . '] does not exist.', null, null);
    }
}