<?php


namespace Controller\Admin;


use Controller\ThemableController;

class LoginController extends ThemableController
{

    public function render()
    {
        return $this->renderLayout("login");
    }
}