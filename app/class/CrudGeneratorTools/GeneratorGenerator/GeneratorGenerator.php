<?php


namespace CrudGeneratorTools\GeneratorGenerator;


use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;
use QuickPdo\QuickPdoInfoTool;

class GeneratorGenerator
{

    public static function create()
    {
        return new static();
    }

    public function generateForeignKeysPreferredColumns($db)
    {

    }


    public function generateForeignKeysPreferredColumnsByTable($table)
    {
        $ret = [];
        list($schema, $table) = CrudGeneratorToolsHelper::getDbAndTable($table);
        $fkInfos = QuickPdoInfoTool::getForeignKeysInfo($table, $schema);
        foreach ($fkInfos as $fkInfo) {

            $fkTable = $fkInfo[0] . '.' . $fkInfo[1];
            if (!array_key_exists($fkTable, $ret)) {
                $types = QuickPdoInfoTool::getColumnDataTypes($fkTable, false);
                foreach ($types as $column => $type) {
                    if ('varchar' === $type) {
                        break;
                    }
                }
                $ret[$fkTable] = $column;
            }
        }
        return $ret;
    }

}