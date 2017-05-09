<?php


namespace Module\Core\ApplicationHandler;


use Bat\ObTool;
use Core\Services\A;
use Core\Services\Hooks;
use Core\Services\X;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Architecture\Router\Web\ApplicationRoutsyRouter;
use Kamille\Architecture\Router\Web\RouteRouter;
use Kamille\Architecture\Routes\Routes;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XConfig;
use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Request\Web\FakeHttpRequest;
use Kamille\Architecture\Request\Web\HttpRequest;
use Kamille\Architecture\RequestListener\Web\ControllerExecuterRequestListener;
use Kamille\Architecture\RequestListener\Web\ResponseExecuterListener;
use Kamille\Architecture\RequestListener\Web\RouterRequestListener;
use Kamille\Architecture\Router\Web\StaticObjectRouter;
use Kamille\Services\XLog;
use Kamille\Utils\Routsy\RoutsyRouter;
use Logger\Logger;
use Module\Core\Architecture\Router\AjaxStaticRouter;
use Module\Core\Architecture\Router\EarlyRouter;
use Module\Core\Architecture\Router\ExceptionRouter;
use QuickPdo\QuickPdo;

class WebApplicationHandler
{

    public function handle(WebApplication $app)
    {
        try {

            $request = HttpRequest::create();

            //--------------------------------------------
            // INITIALIZE LOGGER
            //--------------------------------------------
            $logger = Logger::create();
            Hooks::call("Core_addLoggerListener", $logger);
            XLog::setLogger($logger); // now XLog is initialized for the rest of the application :)

            if (true === ApplicationParameters::get('debug')) {
                XLog::debug("[Core module] - WebApplicationHandler.handle with uri: " . $request->uri());
            }


            if (true === XConfig::get("Core.useQuickPdo")) {
                A::quickPdoInit();
            }


//            $uri2Controller = [];
//            Hooks::call("Core_feedUri2Controller", $uri2Controller);


            $uri2Controllers = [];
            $ajaxRouter = AjaxStaticRouter::create();
            Hooks::call("Core_feedAjaxUri2Controllers", $uri2Controllers);
            $ajaxRouter->setUri2Controllers($uri2Controllers);


            $earlyRouter = EarlyRouter::create();
            $earlyRouter->addRouter(ExceptionRouter::create()->setController(XConfig::get("Core.exceptionController")));
            $earlyRouter->addRouter($ajaxRouter);
            Hooks::call("Core_feedEarlyRouter", $earlyRouter);


            HtmlPageHelper::addMeta(['charset' => "UTF-8"]);


            $app
                ->addListener(RouterRequestListener::create()
                    ->addRouter($earlyRouter)
                    ->addRouter(ApplicationRoutsyRouter::create())
//                    ->addRouter(StaticObjectRouter::create()
//                        ->setDefaultController(XConfig::get("Core.fallbackController"))
//                        ->setUri2Controller($uri2Controller))
//        ->addRouter(StaticPageRouter::create()
//            ->setStaticPageController(X::getStaticPageRouter_StaticPageController())
//            ->setUri2Page(X::getStaticPageRouter_Uri2Page()))
                )
                ->addListener(ControllerExecuterRequestListener::create())
                ->addListener(ResponseExecuterListener::create());


            $app->handleRequest($request);


        } catch (\Exception $e) {

            /**
             * @var $oldRequest HttpRequestInterface
             */
            $oldRequest = $app->get('request');
            if ($oldRequest instanceof HttpRequestInterface) {
                $sUri = $oldRequest->uri();
            } else {
                $sUri = " not set (no request key found in the HttpRequest object)";

            }
            XLog::error("[Core module] - WebApplicationHandler: exception caught with message: '" . $e->getMessage() . "'. uri was " . $sUri . ", redispatching to the fallback loop");

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
