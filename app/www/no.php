<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Logger\Formatter\TagFormatter;
use Logger\Listener\FileLoggerListener;
use Logger\Logger;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";


$f = "/myphp/kaminos/app/config/laws/exception.conf.php";
$conf = [];
include $f;



foreach($conf['widgets'] as $a){
    a($a);
}