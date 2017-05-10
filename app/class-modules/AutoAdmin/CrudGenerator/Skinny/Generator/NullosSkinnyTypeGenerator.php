<?php


namespace Module\AutoAdmin\CrudGenerator\Skinny\Generator;


use CrudGeneratorTools\Skinny\Generator\SkinnyTypeGenerator;
use CrudGeneratorTools\Skinny\Helper\SkinnyHelper;
use Kamille\Ling\Z;
use Kamille\Services\XLog;
use Module\AutoAdmin\CrudGenerator\Helper\AutoAdminCrudGeneratorHelper;

class NullosSkinnyTypeGenerator extends SkinnyTypeGenerator
{
    public function __construct()
    {
        parent::__construct();
        $this->setDstDir(Z::appDir() . "/store/AutoAdmin/skinny-types/auto");
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function onTypeChosen(&$chosenType, $column, $table, $db, $type, $detailedType, $isAutoInc, $foreignKey, $isNullable)
    {

        if ('selectForeignKey' === $chosenType) {
            $preferred = AutoAdminCrudGeneratorHelper::getForeignKeyPreferredColumn([$db]);
            $fullTable = "$db.$table";
            $foreignTable = $foreignKey[0] . "." . $foreignKey[1];
            if (array_key_exists($foreignTable, $preferred)) {
                $preferredCol = $preferred[$foreignTable];
                $foreignCol = $foreignKey[2];
                $query = 'select ' . $foreignCol . ', ' . $preferredCol . ' from ' . $foreignTable;
                $params = [
                    'query' => $query,
                ];

                if (true === $isNullable) {
                    $firstOptionLabel = "Please choose an option";
                    $firstOptionValue = 0;
                    $params['firstOptionLabel'] = $firstOptionLabel;
                    $params['firstOptionValue'] = $firstOptionValue;
                }

                SkinnyHelper::addParams($chosenType, $params);

            } else {
                XLog::error("Fulltable $fullTable not found in foreign key preferred columns ($db.$table.$column)");
            }
        } elseif ('autocomplete' === $chosenType) {
            $foreignTable = $foreignKey[0] . "." . $foreignKey[1];
            $module = $this->module;
            $uri = "/service/json/$module/autocomplete/auto/$foreignTable";
            $params = [
                'uri' => $uri,
            ];
            SkinnyHelper::addParams($chosenType, $params);
        } elseif ('upload' === $chosenType) {
            $profileId = $this->module . "/$db.$table.$column";
            $params = [
                'profileId' => $profileId,
            ];
            SkinnyHelper::addParams($chosenType, $params);
        }
    }

}