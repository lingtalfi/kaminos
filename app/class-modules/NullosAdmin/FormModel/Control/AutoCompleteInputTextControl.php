<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\InputTextControl;

class AutoCompleteInputTextControl extends InputTextControl
{

    private $_uri;

    public function __construct()
    {
        parent::__construct();
        $this->type = "autocomplete";
    }

    public function uri($uri)
    {
        $this->_uri = $uri;
        return $this;
    }

    protected function prepareArray(array &$array)
    {
        $array['js'] = [
            'uri' => $this->_uri,
        ];
        parent::prepareArray($array);
    }


}