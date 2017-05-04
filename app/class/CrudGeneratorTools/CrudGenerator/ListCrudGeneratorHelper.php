<?php


namespace CrudGeneratorTools\CrudGenerator;


use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;
use QuickPdo\QuickPdoInfoTool;

class ListCrudGeneratorHelper extends CrudGeneratorHelper
{

    protected $table2foreignKeyPreferredColumn;

    public function __construct()
    {
        parent::__construct();
        $this->table2foreignKeyPreferredColumn;
    }


    public function getSqlQuery($table)
    {
        $prefixedColumns = $this->getPrefixesColumns($table);
        $joins = $this->getJoinsList($table);
        return [
            $prefixedColumns,
            $joins,
        ];
    }

    public function getSqlQueryAsString($table)
    {
        list($prefixedColumns, $joins) = $this->getSqlQuery($table);
        $q = "SELECT\n";
        $q .= implode(",\n", $prefixedColumns) . "\n";
        $q .= "FROM $table\n";
        $q .= implode("\n", $joins[0]) . "\n";
        $q .= implode("\n", $joins[1]) . "\n";
        return $q;
    }

    public function setTable2foreignKeyPreferredColumn(array $table2foreignKeyPreferredColumn)
    {
        $this->table2foreignKeyPreferredColumn = $table2foreignKeyPreferredColumn;
        return $this;
    }

    protected function generateMenu()
    {
        foreach ($this->databases as $db) {
            $tables = CrudGeneratorToolsHelper::getTables($db, false);
            foreach ($tables as $table) {
                // here, override this method and so something concrete and useful for your application...
            }
        }
    }



//    private static function getForeignTables($table, $db = null)
//    {
//        $fkInfo = QuickPdoInfoTool::getForeignKeysInfo($table, $db);
//        return array_map(function ($v) {
//            return $v[0] . '.' . $v[1];
//        }, $fkInfo);
//    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getForeignKeyPreferredColumn($foreignSchema, $foreignTable, $foreignColumn, $hostSchema, $hostTable, $hostColumn)
    {
        $fTable = $foreignSchema . "." . $foreignTable;
        if (array_key_exists($fTable, $this->table2foreignKeyPreferredColumn)) {
            return $foreignTable . "." . $this->table2foreignKeyPreferredColumn[$fTable];
        }
        return $foreignTable . "." . $foreignColumn;
    }


    protected function getJoinsList($table)
    {
        $inner = [];
        $left = [];

        $col2Nullable = QuickPdoInfoTool::getColumnNullabilities($table);
        list($db, $tableOnly) = CrudGeneratorToolsHelper::getDbAndTable($table);
        $fkInfo = QuickPdoInfoTool::getForeignKeysInfo($tableOnly, $db);
        foreach ($fkInfo as $column => $info) {
            $ftable = $info[1];
            $fcol = $info[2];
            $join = "join $ftable on $ftable.$fcol=$tableOnly.$column";
            if (array_key_exists($column, $col2Nullable) && true === $col2Nullable[$column]) {
                $left[] = "left $join";
            } else {
                $inner[] = "inner $join";
            }
        }

        return [
            $inner,
            $left,
        ];
    }


    protected function getPrefixesColumns($table)
    {
        $prefixedColumns = [];
        list($schema, $tableOnly) = CrudGeneratorToolsHelper::getDbAndTable($table);
        $foreignKeysInfo = CrudGeneratorToolsHelper::getForeignKeysInfo($table);
        $columns = CrudGeneratorToolsHelper::getColumns($table);
        foreach ($columns as $col) {
            if (array_key_exists($col, $foreignKeysInfo)) {
                $info = $foreignKeysInfo[$col];
                $prefixedColumns[] = $this->getForeignKeyPreferredColumn($info[0], $info[1], $info[2], $schema, $tableOnly, $col);
            } else {
                $prefixedColumns[] = $tableOnly . "." . $col;
            }
        }

        // ensuring that all ric fields are present
        $ric = CrudGeneratorToolsHelper::getRic($table);
        $ric = array_map(function ($v) use ($tableOnly) {
            return $tableOnly . "." . $v;
        }, $ric);
        $prefixedColumns = array_merge($ric, $prefixedColumns);
        $prefixedColumns = array_unique($prefixedColumns);

        return $prefixedColumns;
    }

}