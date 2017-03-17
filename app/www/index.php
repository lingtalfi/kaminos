<?php


use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\ApplicationParameters\Web\WebApplicationParameters;
use Kamille\Architecture\Request\Web\HttpRequest;
use Kamille\Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Kamille\Architecture\RequestListener\Web\ResponseExecuterListener;
use Kamille\Architecture\RequestListener\Web\RouterRequestListener;
use Kamille\Architecture\Router\Web\StaticObjectRouter;
use Services\X;


require_once __DIR__ . "/../init.php";

WebApplicationParameters::boot();





WebApplication::inst()
    ->set('theme', "gentelella")// this application uses a theme
    ->addListener(RouterRequestListener::create()
        ->addRouter(StaticObjectRouter::create()->setUri2Controller(X::getStaticObjectRouter_Uri2Controller()))
//        ->addRouter(StaticPageRouter::create()
//            ->setStaticPageController(X::getStaticPageRouter_StaticPageController())
//            ->setUri2Page(X::getStaticPageRouter_Uri2Page()))
    )
    ->addListener(ControllerExecuterRequestListener::create())
    ->addListener(ResponseExecuterListener::create())
    ->handleRequest(HttpRequest::create());

