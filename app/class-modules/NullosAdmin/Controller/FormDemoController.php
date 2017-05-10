<?php


namespace Controller\NullosAdmin;


use FormModel\Control\InputCheckBoxControl;
use FormModel\Control\InputFileControl;
use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputRadioControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\Control\SelectControl;
use FormModel\Control\TextAreaControl;
use FormModel\FormModel;
use Module\NullosAdmin\FormModel\Control\AutoCompleteInputTextControl;
use Module\NullosAdmin\FormModel\Control\ColorInputTextControl;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;
use Module\NullosAdmin\FormModel\Control\HtmlTextAreaControl;
use Module\NullosAdmin\FormModel\Control\InputSwitchControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

class FormDemoController extends NullosAdminController
{


    public function renderForm()
    {
        $key = "AuthenticateController_renderForm";
        $tf = "common/form";
        $t = $this->getTranslationContext();


        a($_POST);
        /**
         * Note: submit buttons are added automatically at the renderer level.
         */
        $formModel = FormModel::create()
            ->setFormErrorPosition("control")
            ->addFormAttribute("id", "demo-form2")
            ->addFormAttribute("class", "form-horizontal form-label-left")
            ->addFormAttribute(null, "data-parsley-validate")
            ->setFormErrorPosition('central')
            ->addControl("name", InputTextControl::create()
                ->label("Name")
                ->name("name")
            )
            ->addControl("password", InputPasswordControl::create()
                ->label("Password")
                ->name("pass")
            )
            ->addControl("disabledInput", InputTextControl::create()
                ->label("Disabled Input")
                ->addHtmlAttribute("disabled", "disabled")
                ->name("disabled")
            )
            ->addControl("readOnlyInput", InputTextControl::create()
                ->label("Read-Only Input")
                ->addHtmlAttribute("readonly", "readonly")
                ->name("readonly")
            )
            ->addControl("message", TextAreaControl::create()
                ->label("Your Message")
                ->addHtmlAttribute("required", "required")
                ->name("message")
            )
            ->addControl("favorite_sports", InputCheckBoxControl::create()
                ->setItems([
                    'karate' => "Karaté",
                    'judo' => "Judo",
                    'kungfu' => "Kung Fu",
                ])
                ->label("What's your favorite sport?")
                ->name("favorite_sports[]")
                ->value(["karate", "judo"])
            )
            ->addControl("favorite_color", InputRadioControl::create()
                ->setItems([
                    'red' => "Red",
                    'blue' => "Blue",
                    'green' => "Green",
                ])
                ->label("What's your favorite color?")
                ->name("favorite_color")
                ->value("red")
            )
            ->addControl("noodles", InputSwitchControl::create()
                ->label("Like noodles?")
                ->name("noodles")
                ->addHtmlAttribute("value", "1")
            )
            ->addControl("country", SelectControl::create()
                ->value("spain")
                ->setItems([
                    'france' => "France",
                    'spain' => "Spain",
                    'italy' => "Italy",
                ])
                ->label("Country")
                ->name("country")
            )
            ->addControl("biography", HtmlTextAreaControl::create()
                ->value("spain")
                ->label("Biography")
                ->name("biography")
            )
            ->addControl("date_holiday", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("Holidays date")
                ->name("date_holiday")
            )
            ->addControl("towns", SelectControl::create()
                ->multiple()
                ->setItems([
                    'chartres' => "Chartres",
                    'tours' => "Tours",
                    'orleans' => "Orléans",
                ])
                ->label("Towns you've lived in")
                ->name("towns[]")
                ->value(["chartres", "tours"])
            )
            ->addControl("products", SqlQuerySelectControl::create()
                ->multiple()
                ->query('select id, concat(id, ". ", produits) from zilu.csv_product_list')
                ->firstOption("Please choose an option", null) // 0|null|mixed: the first option's value
                ->label("Select a zilu product")
                ->name("product")
            )
            ->addControl("countries2", AutoCompleteInputTextControl::create()
                ->uri('/service/json/NullosAdmin/autocomplete/demo.autocomplete')
                ->label("Countries")
                ->name("countries2")
            )
            ->addControl("avatar", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("Ekom.default_image")
                ->label("Avatar")
                ->name("avatar")
            )
            ->addControl("color", ColorInputTextControl::create()
                ->label("Color")
                ->addHtmlAttribute("value", "#c00")
                ->name("color")
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