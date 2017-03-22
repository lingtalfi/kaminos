<?php


use Architecture\Application\Web\WebApplication;
use Architecture\Request\Web\HttpRequest;
use Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Architecture\RequestListener\Web\RouterRequestListener;
use Architecture\Router\Web\StaticPageRouter;



require_once __DIR__ . "/../init.php";


//--------------------------------------------
// SETTING PARAMS
//--------------------------------------------
/**
 * Since we are using a WebApplication, params depend on the environment (dev, prod, ...).
 *
 * If $env is our environment, the config/application-parameters-$env.php file contains the application parameters.
 * Additionally, we can still manually set application parameters by using directly the "set" method of the
 * web application, like in the example below.
 *
 *
 */

WebApplication::inst()
    ->set('k', 'k')
    ->addListener(RouterRequestListener::create()->addRouter(StaticPageRouter::create()))
    ->addListener(ControllerExecuterRequestListener::create())
    ->handleRequest(HttpRequest::create());