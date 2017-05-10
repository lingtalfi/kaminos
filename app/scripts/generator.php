<?php


use Core\Services\A;
use Module\AutoAdmin\CrudGenerator\NullosCrudGenerator;
use Module\AutoAdmin\CrudGenerator\Skinny\Generator\NullosSkinnyTypeGenerator;

require_once __DIR__ . "/../boot.php";


A::quickPdoInit();



NullosSkinnyTypeGenerator::create()->setDatabases(['zilu'])->generate();


az("aaahhhhh");
NullosCrudGenerator::create()->setDatabases(['zilu'])->generate();