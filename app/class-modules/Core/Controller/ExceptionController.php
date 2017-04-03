<?php


namespace Module\Core\Controller;


use Kamille\Architecture\Controller\ControllerInterface;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Ling\Z;

class ExceptionController implements ControllerInterface
{


    public function render()
    {
        $exception = Z::requestParam("exception");
        if ($exception instanceof \Exception) {
            $msg = $exception->getMessage();
        } else {
            $msg = "exception key not found in Request";
        }
        return HttpResponse::create("An exception occurred with message: $msg");
    }
}