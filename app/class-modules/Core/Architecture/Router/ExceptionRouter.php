<?php


namespace Module\Core\Architecture\Router;


use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Architecture\Router\Helper\RouterHelper;
use Kamille\Architecture\Router\RouterInterface;

class ExceptionRouter implements RouterInterface
{

    /**
     * The controller to handle the exception (probably a string)
     */
    private $controller;

    public static function create()
    {
        return new static();
    }

    public function match(HttpRequestInterface $request)
    {
        if (null !== ($exception = $request->get('exception'))) {
            return RouterHelper::routerControllerToCallable($this->controller);
        }
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

}