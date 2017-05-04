<?php


namespace MyGen;


use CrudGeneratorTools\CrudGenerator\ListCrudGeneratorHelper;
use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;

class MyGenListCrudGeneratorHelper extends ListCrudGeneratorHelper{

    protected function generateMenu()
    {
        foreach ($this->databases as $db) {
            $tables = CrudGeneratorToolsHelper::getTables($db, false);
            foreach ($tables as $table) {
                // here, override this method and so something concrete and useful for your application...
            }
        }
    }
}