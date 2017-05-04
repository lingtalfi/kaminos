<?php


use CrudGeneratorTools\CrudGenerator\ListCrudGeneratorHelper;
use QuickPdo\QuickPdo;

require_once __DIR__ . "/../boot.php";



//--------------------------------------------
// PLAYGROUND
//--------------------------------------------
QuickPdo::setConnection("mysql:dbname=oui;host=127.0.0.1", "root", "root", [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
]);


$gen = ListCrudGeneratorHelper::create()->setDatabases([
    'oui',
    'zilu',
]);


// list of all tables in oui
a($gen->getTables("oui", true));

// returns an array containing the fields and the joins involved in displaying a simple view of the oui.concours table
a($gen->getSqlQuery("oui.concours"));