<?php


use MethodInjector\Method\Method;
use MethodInjector\MethodInjector;


ini_set("display_errors", 1);
require __DIR__ . "/../boot.php";







$m = new Method();
$m->setName("Core_applicationConfigurator");

MethodInjector::create()->removeMethod($m, '\Core\Services\X');