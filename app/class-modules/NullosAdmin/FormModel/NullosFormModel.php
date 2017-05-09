<?php


namespace Module\NullosAdmin\FormModel;


use FormModel\FormModel;

class NullosFormModel extends FormModel
{
    public function __construct()
    {
        parent::__construct();
        $this
            ->setSubmitButtonBar([
                'enable' => true,
                'textSubmitButton' => "Submit",
                'textResetButton' => "Reset",
                'showResetButton' => true,
            ])
            ->setFormErrorPosition('central');
    }


}