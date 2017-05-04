<?php


namespace CrudGeneratorTools\CrudGenerator;


use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;
use QuickPdo\QuickPdoInfoTool;

class CrudGeneratorHelper
{
    protected $databases;


    public function __construct()
    {
        $this->databases = [];
    }

    public static function create()
    {
        return new static();
    }

    public function setDatabases(array $databases)
    {
        $this->databases = $databases;
        return $this;
    }




}