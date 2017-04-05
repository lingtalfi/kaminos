<?php


namespace Module\Core\Controller;


use Kamille\Architecture\Controller\ControllerInterface;
use Kamille\Architecture\Response\Web\HttpResponse;

class FallbackPageController implements ControllerInterface
{


    public function render()
    {
        return HttpResponse::create("I'm the default home page from the Core module's CoreDefaultController.");
    }
}