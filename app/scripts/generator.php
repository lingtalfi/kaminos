<?php


use Core\Services\A;
use Module\AutoAdmin\CrudGenerator\NullosCrudGenerator;

require_once __DIR__ . "/../boot.php";


A::quickPdoInit();
NullosCrudGenerator::create()->setDatabases(['zilu'])->generate();