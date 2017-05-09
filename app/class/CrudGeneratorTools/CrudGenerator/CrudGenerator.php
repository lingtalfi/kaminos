<?php


namespace CrudGeneratorTools\CrudGenerator;


use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;

class CrudGenerator implements CrudGeneratorInterface
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


    public function generate()
    {
        $this->generateMenu();
        $this->generateItems();
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function generateMenu()
    {
        $db2Tables = [];
        foreach ($this->databases as $db) {
            $tables = CrudGeneratorToolsHelper::getTables($db, false);
            $db2Tables[$db] = $tables;
        }
        $this->doGenerateMenu($db2Tables);
    }

    protected function doGenerateMenu(array $db2Tables)
    {
        foreach ($db2Tables as $db => $table) {
            a("generating menu: $db.$table");
        }
    }

    protected function generateItems()
    {
        $db2Tables = [];
        foreach ($this->databases as $db) {
            $tables = CrudGeneratorToolsHelper::getTables($db, false);
            $db2Tables[$db] = $tables;
        }
        $this->doGenerateItems($db2Tables);
    }


    protected function doGenerateItems(array $db2Tables)
    {
        foreach ($db2Tables as $db => $table) {
            a("generating item: $db.$table");
        }
    }
}