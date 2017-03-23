<?php


use Packer\Packer;
use TokenFun\TokenFinder\ParentClassNameTokenFinder;
use TokenFun\TokenFinder\Tool\TokenFinderTool;
use TokenFun\Tool\TokenTool;


ini_set("display_errors", 1);
require __DIR__ . "/../boot.php";




$d = "/myphp/kamille-installer-tool/pprivate";
$packer = new Packer();
$c = $packer->pack($d);








