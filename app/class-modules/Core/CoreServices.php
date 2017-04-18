<?php


namespace Module\Core;


class CoreServices
{

    protected static function Core_webApplicationHandler()
    {
        return new \Module\Core\ApplicationHandler\WebApplicationHandler();
    }


    protected static function Core_routes()
    {
        $routes =  new \Kamille\Architecture\Routes\Routes();
        \Core\Services\Hooks::call("Core_feedRoutes", $routes);
        return $routes;
    }
}


