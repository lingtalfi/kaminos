<?php


namespace CrudGeneratorTools\CrudGenerator;


use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;

class ListCrudGeneratorHelper extends CrudGeneratorHelper
{

    public function getSqlQuery($table)
    {

        list($schema, $tableOnly) = CrudGeneratorToolsHelper::getDbAndTable($table);

        $prefixedColumns = [];
        $foreignKeysInfo = $this->getForeignKeysInfo($table);


        $columns = $this->getColumns($table);


        foreach ($columns as $col) {
            if (array_key_exists($col, $foreignKeysInfo)) {
                $info = $foreignKeysInfo[$col];
                $prefixedColumns[] = $info[1] . "." . $this->getForeignKeyPreferredColumn($info[1], $info[2], $tableOnly, $col);
            } else {
                $prefixedColumns[] = $tableOnly . "." . $col;
            }
        }

        a($prefixedColumns);
    }


    protected function getForeignKeyPreferredColumn($foreignTable, $foreignColumn, $hostTable, $hostColumn)
    {
        $string = $foreignTable . "." . $foreignColumn;
        switch ($string){
            //--------------------------------------------
            // REPLACE WITH YOUR OWN
            //--------------------------------------------
            /**
             * Use the generatorGenerator to help you generate the content below,
             * then extend this class and make your own personalized MyAppListCrudGeneratorHelper (for instance).
             */
            case 'all':
                break;
            default:
                break;
        }
        return $foreignColumn;
    }

}