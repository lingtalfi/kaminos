<?php


use Packer\Packer;

require_once __DIR__ . "/../boot.php";



$d = "/myphp/kamille-installer-tool/pprivate";
$packer = new Packer();
a($packer->pack($d));






