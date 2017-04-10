<?php


namespace Controller\Kaminos;


use Core\Controller\ApplicationController;


class AuthenticationController extends ApplicationController
{


    public function render()
    {
        return $this->renderByViewId("bo-login");
    }


}