<?php



namespace Controller\Test;



use Kamille\Architecture\Controller\Web\KamilleController;

class TestController extends KamilleController{



    public function render(){
        return $this->renderByViewId("meow");
    }


}