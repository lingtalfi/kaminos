<?php


namespace Controller\NullosAdmin;


use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\FormModel;

class TestPageController extends NullosAdminController
{


    public function render()
    {
        $key = "AuthenticateController_renderForm";
        $tf = "common/form";
        $t = $this->getTranslationContext();


        $formModel = FormModel::create()
            ->setFormErrorPosition('central')
            ->addControl("name", InputTextControl::create()
                ->placeholder(__("label.name", $tf))
                ->name("name")
            )
            ->addControl("password", InputPasswordControl::create()
                ->placeholder(__("label.password", $tf))
                ->name("pass")
            )
            ->addControl("submit", InputSubmitControl::create()
                ->name($key)
                ->addHtmlAttribute("value", __("label.login", $t))
            );

        return $this->renderByViewId("NullosAdmin/testPage", [
            'widgets' => [
                "maincontent.form" => [
                    "conf" => [
                        "formModel" => $formModel->getArray(),
                    ],
                ],
            ],
        ]);
    }


}