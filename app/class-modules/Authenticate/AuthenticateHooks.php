<?php


namespace Module\Authenticate;


class AuthenticateHooks
{

    protected static function Core_feedEarlyRouter(\Module\Core\Architecture\Router\EarlyRouter $router)
    {
        $router->addRouter(\Module\Authenticate\Architecture\Router\AuthenticateRouter::create());
    }
}


