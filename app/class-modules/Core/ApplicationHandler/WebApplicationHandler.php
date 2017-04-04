<?php


namespace Module\Core\ApplicationHandler;


use Bat\ObTool;
use Core\Services\Hooks;
use Kamille\Services\XConfig;
use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Request\Web\FakeHttpRequest;
use Kamille\Architecture\Request\Web\HttpRequest;
use Kamille\Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Kamille\Architecture\RequestListener\Web\ResponseExecuterListener;
use Kamille\Architecture\RequestListener\Web\RouterRequestListener;
use Kamille\Architecture\Router\Web\StaticObjectRouter;
use Module\Core\Architecture\Router\ExceptionRouter;

class WebApplicationHandler
{
    public function handle(WebApplication $app)
    {


        $uri2Controller = [];
        Hooks::call("Core.feedUri2Controller", $uri2Controller);


        try {

            $app->addListener(RouterRequestListener::create()
                ->addRouter(ExceptionRouter::create()->setController(XConfig::get("Core.exceptionController")))
                ->addRouter(StaticObjectRouter::create()
                    ->setDefaultController(XConfig::get("Core.defaultController"))
                    ->setUri2Controller($uri2Controller))
//        ->addRouter(StaticPageRouter::create()
//            ->setStaticPageController(X::getStaticPageRouter_StaticPageController())
//            ->setUri2Page(X::getStaticPageRouter_Uri2Page()))
            )
                ->addListener(ControllerExecuterRequestListener::create())
                ->addListener(ResponseExecuterListener::create());

            $app->handleRequest(HttpRequest::create());


        } catch (\Exception $e) {

            ObTool::cleanAll(); // clean all buffers to avoid content leaks

            $oldRequest = $app->get('request');
            $request = FakeHttpRequest::create()
                ->set("oldRequest", $oldRequest)
                ->set("exception", $e);
            $app->handleRequest($request);
        }


    }
}
