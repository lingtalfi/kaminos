<?php


namespace Controller\Core;


use Kamille\Architecture\Controller\ControllerInterface;
use Kamille\Architecture\Response\Web\HttpResponse;

class CoreDefaultController implements ControllerInterface
{


    public function render()
    {
        throw new \Exception("kkpp");
        return HttpResponse::create("I'm the default home page from the Core module's CoreDefaultController.");
    }
}