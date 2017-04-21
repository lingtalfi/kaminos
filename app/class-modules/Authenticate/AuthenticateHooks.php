<?php


namespace Module\Authenticate;


class AuthenticateHooks
{

    protected static function Core_feedEarlyRouter(\Module\Core\Architecture\Router\EarlyRouter $router)
    {
        $router->addRouter(\Module\Authenticate\Architecture\Router\AuthenticateRouter::create());
    }


//    protected static function Core_feedRoutes(\Kamille\Architecture\Routes\RoutesInterface $routes)
//    {
//        $routes->addRoute("Authenticate_loginFormSuccess", \Kamille\Architecture\Route\StaticRoute::create()
//            ->setController(\Kamille\Services\XConfig::get("Authenticate.controllerLoginFormSuccess"))
//            ->setUri(\Kamille\Services\XConfig::get("Authenticate.uriLoginFormSuccess")));
//    }

}


