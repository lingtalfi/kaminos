<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\HtmlControl;

class DropZoneControl extends HtmlControl
{

    private $value;
    private $conf;

    public function __construct()
    {
        parent::__construct();
        $this->type = "dropzone";
        $this->value = [];
        $this->conf = [
            "showDeleteLink" => true,
            "profileId" => null,
        ];
    }


    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setShowDeleteLink($bool)
    {
        $this->conf["showDeleteLink"] = $bool;
        return $this;
    }

    public function setProfileId($profileId)
    {
        $this->conf["profileId"] = $profileId;
        return $this;
    }

    protected function prepareArray(array &$array)
    {
        $array['conf'] = $this->conf;
        $array['value'] = $this->value;
    }
}