<?php


namespace Controller\NullosAdmin;


class HomePageController extends NullosAdminController
{


    public function render()
    {
        return $this->renderByViewId("NullosAdmin/homePage");
    }


}