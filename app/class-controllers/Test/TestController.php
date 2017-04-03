<?php



namespace Controller\Test;



use Kamille\Architecture\Controller\Web\KamilleController;

class TestController extends KamilleController{



    public function doo(){
        return $this->renderByViewId("meow");
    }


}