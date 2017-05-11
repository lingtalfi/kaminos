<?php


use Core\Services\A;
use Module\AutoAdmin\CrudGenerator\NullosCrudGenerator;


ini_set('display_errors', "1");
require_once __DIR__ . "/../boot.php";
A::quickPdoInit();


NullosCrudGenerator::create()
    ->useCache(true)
    ->setLogFunction(function ($type, $msg) {
        a($type . ":" . $msg);
    })
    ->setModule("Ekom")
    ->generate('kamille');



