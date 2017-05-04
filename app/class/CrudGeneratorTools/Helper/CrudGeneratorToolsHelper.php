<?php


namespace CrudGeneratorTools\Helper;


use QuickPdo\QuickPdoInfoTool;

class CrudGeneratorToolsHelper{


    public static function getDbAndTable($table)
    {
        $p = explode('.', $table, 2);
        $schema = null;
        if (2 === count($p)) {
            return $p;
        }
        return [null, $table];
    }



    public static function getTables($db = null, $useDbPrefix = true)
    {
        $ret = [];
        if (null === $db) {
            $db = $this->databases;
            QuickPdoInfoTool::getDatabases();
        } elseif (!is_array($db)) {
            $db = [$db];
        }

        foreach ($db as $d) {
            $tables = QuickPdoInfoTool::getTables($d);
            if (true === $useDbPrefix) {
                $tables = array_map(function ($v) use ($d) {
                    return $d . '.' . $v;
                }, $tables);
            }
            $ret = array_merge($ret, $tables);
        }
        return $ret;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    public static function getColumns($table)
    {
        list($schema, $table) = CrudGeneratorToolsHelper::getDbAndTable($table);
        return QuickPdoInfoTool::getColumnNames($table, $schema);
    }

    public static function getForeignKeysInfo($table)
    {
        list($schema, $table) = CrudGeneratorToolsHelper::getDbAndTable($table);
        return QuickPdoInfoTool::getForeignKeysInfo($table, $schema);
    }
}