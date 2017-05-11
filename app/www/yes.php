<?php


use Core\Services\A;
use CrudGeneratorTools\Util\ForeignKeyPreferredColumnUtil;
use Module\AutoAdmin\CrudGenerator\NullosCrudGenerator;
use QuickPdo\Util\QuickPdoInfoCacheUtil;


/**
 * Kamille framework init
 */
ini_set('display_errors', "1");
require_once __DIR__ . "/../boot.php";
A::quickPdoInit();



a(QuickPdoInfoCacheUtil::create()->getColumnDataTypes('zilu.container'));
az();


NullosCrudGenerator::create()
    ->setDatabases(['zilu'])
    ->setModule("AutoAdmin")
    ->generate();



