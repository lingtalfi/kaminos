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
use Module\NullosAdmin\FormModel\Control\ColorInputTextControl;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;
use Module\NullosAdmin\FormModel\Control\HtmlTextAreaControl;
use Module\NullosAdmin\FormModel\Control\InputSwitchControl;

class UsersController extends NullosAdminController
{


    public function renderList()
    {
        return $this->renderByViewId("NullosAdmin/users", [
//            'widgets' => [
//                "maincontent.dataTable" => [
//                    'conf' => [
//                        "profileId" => "NullosAdmin/users",
//                    ],
//                ],
//            ],
        ]);
    }


}