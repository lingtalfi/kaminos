<?php


namespace Module\Authenticate\Architecture\Router;


use Authenticate\SessionUser\SessionUser;
use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Architecture\Router\Helper\RouterHelper;
use Kamille\Architecture\Router\RouterInterface;
use Kamille\Services\XConfig;

class AuthenticateRouter implements RouterInterface
{

    public static function create()
    {
        return new static();
    }

    public function match(HttpRequestInterface $request)
    {
        if (false === SessionUser::isConnected()) {
            return RouterHelper::routerControllerToCallable(XConfig::get("Authenticate.controllerLoginForm"));
        }
    }
}