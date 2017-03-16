<?php


namespace Controller\Admin;


use Controller\ThemableController;

class HomeController extends ThemableController
{

    public function render()
    {
        return $this->renderLayout("dashboard");
    }
}