<?php


namespace Controller\Exception;


use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Controller\Web\KamilleController;

class ExceptionController extends KamilleController
{


    public function render()
    {
        $fn = function ($params) {
            $msgType = $params[0];
            switch ($msgType){
                case 'widgetNameNotFound':
                    XLog::error("todo: make XLog available...");
                    break;
                default:
                    break;
            }
        };


        $request = WebApplication::inst()->get("request");
        $e = $request->get("exception");

        return $this->renderByViewId("exception", [
            "widgets" => [
                "ff" => [
                    "conf" => [
                        "exception" => $e,
                    ],
                ],
            ],
        ]);
    }


}