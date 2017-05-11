<?php


namespace Module\AutoAdmin\CrudGenerator\Skinny\Generator;


use CrudGeneratorTools\Skinny\Helper\SkinnyHelper;
use CrudGeneratorTools\Skinny\SkinnyTypeUtil;
use CrudGeneratorTools\Util\ForeignKeyPreferredColumnUtil;
use Kamille\Ling\Z;
use Kamille\Services\XLog;
use Module\AutoAdmin\CrudGenerator\Util\NullosForeignKeyPreferredColumnUtil;

class NullosSkinnyTypeUtil extends SkinnyTypeUtil
{


    /**
     * @var ForeignKeyPreferredColumnUtil $foreignKeyPreferredColumnUtil
     */
    private $foreignKeyPreferredColumnUtil;

    /**
     * @var string, used to generate params for autocomplete and upload types
     */
    private $module;
    private $_useCache;


    public function __construct()
    {
        parent::__construct();
        $this->setCacheDir(Z::appDir() . "/store/AutoAdmin/skinny-types/auto");
        $this->_useCache = true;
    }

    public function setForeignKeyPreferredColumnUtil(ForeignKeyPreferredColumnUtil $foreignKeyPreferredColumnUtil)
    {
        $this->foreignKeyPreferredColumnUtil = $foreignKeyPreferredColumnUtil;
        return $this;
    }

    public function useCache($useCache)
    {
        $this->_useCache = $useCache;
        return $this;
    }

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function onTypeChosen(&$chosenType, $column, $table, $db, $type, $detailedType, $isAutoInc, $foreignKey, $isNullable)
    {

        if ('selectForeignKey' === $chosenType) {
            $preferredCol = $this->foreignKeyPreferredColumnUtil->getPreferredForeignKey($foreignKey[0], $foreignKey[1], $this->_useCache);
            if (false !== $preferredCol) {
                $foreignTable = $foreignKey[0] . "." . $foreignKey[1];
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
                $fullTable = "$db.$table";
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


    protected function prepare()
    {
        if (null === $this->foreignKeyPreferredColumnUtil) {
            $this->foreignKeyPreferredColumnUtil = NullosForeignKeyPreferredColumnUtil::create();
        }
        parent::prepare();
    }


}