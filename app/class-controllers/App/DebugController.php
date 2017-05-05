<?php


namespace Controller\App;


use Controller\NullosAdmin\NullosAdminController;



class DebugController extends NullosAdminController
{


    public function render()
    {
        return $this->renderByViewId("debug");
    }

}