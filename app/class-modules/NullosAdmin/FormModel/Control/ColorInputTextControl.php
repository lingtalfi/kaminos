<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\InputTextControl;

class ColorInputTextControl extends InputTextControl
{

    public function __construct()
    {
        parent::__construct();
        $this->type = "colorPicker";
    }
}