Installation
====================================

Composer
------------------------------------
You will need primarily only Laravel to run core.

``composer require nukacode/front-end-bootstrap:~1.0``

Routes
------------------------------------
If you would like to use the included routes, add the following to your ``app/Http/routes.php`` file.

``include_once(base_path() .'/vendor/nukacode/bootstrap/src/routes.php');``

Service Providers
------------------------------------
Add the following service providers to ``configs/app.php``.
::

     'NukaCode\Bootstrap\BootstrapServiceProvider',
     'NukaCode\Bootstrap\Html\HtmlServiceProvider',
Themes
------------------------------------
Bower
~~~~~~~
.. hint:: You only need to have one of these.
::

    bower install -S nukacode-bootstrap-base#~0
    bower install -S nukacode-bootstrap-dark#~0
Resources
~~~~~~~~~
At the top of ``resources/assets/less/app.less`` add the line below that matches your theme.  Make sure this is first line of that file.
::

    @import '../../../vendor/bower_components/nukacode-bootstrap-base/less/base';
    @import '../../../vendor/bower_components/nukacode-bootstrap-dark/less/dark';