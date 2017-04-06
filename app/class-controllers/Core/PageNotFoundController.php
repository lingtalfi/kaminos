<?php


namespace Controller\Core;


use Kamille\Architecture\Controller\ControllerInterface;
use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Architecture\Response\Web\HttpResponse;

class PageNotFoundController extends KamilleController
{


    public function render()
    {
        return $this->renderByViewId("pageNotFound");
    }


}