<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\InputTickableControl;

class InputSwitchControl extends InputTickableControl
{

    public function __construct()
    {
        parent::__construct();
        $this->type = "switch";
        $this->addHtmlAttribute("type", "checkbox");
    }
}