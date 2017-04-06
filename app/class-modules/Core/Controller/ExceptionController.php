<?php


namespace Controller\Core;


use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Controller\Web\KamilleController;

class ExceptionController extends KamilleController
{


    public function render()
    {
        $request = WebApplication::inst()->get("request");
        $e = $request->get("exception");


        // using lnc1.splash
        return $this->renderByViewId("exception", [
            "widgets" => [
                "main.exception" => [
                    "conf" => [
                        "exception" => $e,
                    ],
                ],
            ],
        ]);
    }


}