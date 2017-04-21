<?php


namespace Module\Authenticate\Architecture\Router;


use Authenticate\SessionUser\SessionUser;
use Bat\UriTool;
use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Architecture\Response\Web\RedirectResponse;
use Kamille\Architecture\Router\Helper\RouterHelper;
use Kamille\Architecture\Router\RouterInterface;
use Kamille\Ling\Z;
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
        } else {
            $dkey = XConfig::get("Authenticate.disconnectGetKey");
            if (array_key_exists($dkey, $_GET)) {
                $get = $_GET;
                unset($get[$dkey]);


                $request->set("response", RedirectResponse::create(Z::uri(null, $get, true, true)));
                SessionUser::disconnect();

                /**
                 * By not returning null, we make the router believe a controller was found,
                 * so that it doesn't loop the other routers.
                 */
                return "";
            } else {
                if (true === XConfig::get("Authenticate.allowSessionRefresh")) {
                    SessionUser::refresh();
                }
            }
        }
    }
}