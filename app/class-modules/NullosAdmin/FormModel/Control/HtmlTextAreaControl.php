<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\TextAreaControl;

class HtmlTextAreaControl extends TextAreaControl
{

    public function __construct()
    {
        parent::__construct();
        $this->type = "htmlTextArea";
    }
}