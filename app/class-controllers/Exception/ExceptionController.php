<?php


namespace Controller\Exception;


use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Controller\Web\KamilleController;

class ExceptionController extends KamilleController
{


    public function render()
    {
        $request = WebApplication::inst()->get("request");
        $e = $request->get("exception");
        return $this->renderByViewId("exception", [
            "widgets" => [
                "main.any" => [
                    "conf" => [
                        "exception" => $e,
                    ],
                ],
            ],
        ]);
    }


}