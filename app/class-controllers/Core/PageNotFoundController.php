<?php


namespace Controller\Core;


use Core\Controller\ApplicationController;
class PageNotFoundController extends ApplicationController
{


    public function render()
    {
        return $this->renderByViewId("Core/pageNotFound");
    }


}