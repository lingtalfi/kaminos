<?php


use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Request\Web\HttpRequest;
use Kamille\Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Kamille\Architecture\RequestListener\Web\ResponseExecuterListener;
use Kamille\Architecture\RequestListener\Web\RouterRequestListener;
use Kamille\Architecture\Router\Web\StaticPageRouter;

require_once __DIR__ . "/../init.php";


WebApplication::inst()
    ->set('theme', "gentelella") // this application uses a theme
    ->addListener(RouterRequestListener::create()->addRouter(StaticPageRouter::create()))
    ->addListener(ControllerExecuterRequestListener::create())
    ->addListener(ResponseExecuterListener::create())
    ->handleRequest(HttpRequest::create());

