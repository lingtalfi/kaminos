<?php


namespace Controller\Authenticate;


use Core\Controller\ApplicationController;
use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\FormModel;

class AuthenticateController extends ApplicationController
{


    public function renderForm()
    {

        $formModelArr = FormModel::create()
            ->setFormErrorPosition('central')
            ->addControl("name", InputTextControl::create()
                ->placeholder("Name")
                ->name("name")
            )
            ->addControl("password", InputPasswordControl::create()
                ->placeholder("Password")
                ->name("age")
            )
            ->addControl("submit", InputSubmitControl::create()
                ->name("form_posted")
                ->addHtmlAttribute("value", "Send")
            )
            ->getArray();


        return $this->renderByViewId("loginForm", [
            "widgets" => [
                "main.loginForm" => [
                    "conf" => [
                        "formModel" => $formModelArr,
                    ],
                ],
            ],
        ]);
    }


}