<?php


namespace Controller\Test;


use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Architecture\Response\Web\HttpResponse;

class TestController extends KamilleController
{


    public function render()
    {
        return $this->renderByViewId("meow");
    }

    public function pou()
    {
        return HttpResponse::create("pou");
    }

}