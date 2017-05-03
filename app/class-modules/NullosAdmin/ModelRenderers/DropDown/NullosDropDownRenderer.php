<?php


namespace Module\NullosAdmin\ModelRenderers\DropDown;


use ModelRenderers\DropDown\BootstrapDropDownRenderer;

class NullosDropDownRenderer extends BootstrapDropDownRenderer
{
    public function __construct()
    {
        parent::__construct();
        $this->linkAttributes['class'] = "special-link";
    }
}