<?php


namespace Module\Core\ApplicationHandler;


use Bat\ObTool;
use Core\Services\Hooks;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Services\XConfig;
use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Request\Web\FakeHttpRequest;
use Kamille\Architecture\Request\Web\HttpRequest;
use Kamille\Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Kamille\Architecture\RequestListener\Web\ResponseExecuterListener;
use Kamille\Architecture\RequestListener\Web\RouterRequestListener;
use Kamille\Architecture\Router\Web\StaticObjectRouter;
use Kamille\Services\XLog;
use Logger\Logger;
use Module\Core\Architecture\Router\EarlyRouter;
use Module\Core\Architecture\Router\ExceptionRouter;

class WebApplicationHandler
{

    public function handle(WebApplication $app)
    {
        try {


            // initialize logger
            $logger = Logger::create();
            Hooks::call("Core_addLoggerListener", $logger);
            XLog::setLogger($logger); // now XLog is initialized for the rest of the application :)

            if (true === ApplicationParameters::get('debug')) {
                XLog::debug("[Core module] - WebApplicationHandler.handle ");
            }


            $uri2Controller = [];
            Hooks::call("Core_feedUri2Controller", $uri2Controller);

            $earlyRouter = EarlyRouter::create();
            $earlyRouter->addRouter(ExceptionRouter::create()->setController(XConfig::get("Core.exceptionController")));
            Hooks::call("Core_feedEarlyRouter", $earlyRouter);


            $app
                ->addListener(RouterRequestListener::create()
                    ->addRouter($earlyRouter)
                    ->addRouter(StaticObjectRouter::create()
                        ->setDefaultController(XConfig::get("Core.fallbackController"))
                        ->setUri2Controller($uri2Controller))
//        ->addRouter(StaticPageRouter::create()
//            ->setStaticPageController(X::getStaticPageRouter_StaticPageController())
//            ->setUri2Page(X::getStaticPageRouter_Uri2Page()))
                )
                ->addListener(ControllerExecuterRequestListener::create())
                ->addListener(ResponseExecuterListener::create());

            $app->handleRequest(HttpRequest::create());


        } catch (\Exception $e) {
            /**
             * @var $oldRequest HttpRequestInterface
             */
            $oldRequest = $app->get('request');
            XLog::error("[Core module] - WebApplicationHandler: exception caught with message: '" . $e->getMessage() . "'. uri was " . $oldRequest->uri() . ", redispatching to the fallback loop");

            if (true === XConfig::get("Core.showExceptionTrace")) {
                XLog::trace("$e");
            }

            ObTool::cleanAll(); // clean all buffers to avoid content leaks

            $request = FakeHttpRequest::create()
                ->set("oldRequest", $oldRequest)
                ->set("exception", $e);
            $app->handleRequest($request);
        }
    }


}
