<?php


namespace Module\Core\ApplicationConfigurator;


use Core\Services\Hooks;
use Core\Services\XConfig;
use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Kamille\Architecture\RequestListener\Web\ResponseExecuterListener;
use Kamille\Architecture\RequestListener\Web\RouterRequestListener;
use Kamille\Architecture\Router\Web\StaticObjectRouter;

class WebApplicationConfigurator
{
    public function configure(WebApplication $app)
    {


        $uri2Controller = [];
        Hooks::call("Core.feedUri2Controller", $uri2Controller);



        $app->addListener(RouterRequestListener::create()
            ->addRouter(StaticObjectRouter::create()
                ->setDefaultController(XConfig::get("Core.defaultController"))
                ->setUri2Controller($uri2Controller))
//        ->addRouter(StaticPageRouter::create()
//            ->setStaticPageController(X::getStaticPageRouter_StaticPageController())
//            ->setUri2Page(X::getStaticPageRouter_Uri2Page()))
        )
            ->addListener(ControllerExecuterRequestListener::create())
            ->addListener(ResponseExecuterListener::create());
    }
}
