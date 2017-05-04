<?php


use CrudGeneratorTools\GeneratorGenerator\GeneratorGenerator;
use QuickPdo\QuickPdo;
use QuickPdo\QuickPdoInfoTool;

require_once __DIR__ . "/../boot.php";



//--------------------------------------------
// GENERATOR GENERATOR EXAMPLE
//--------------------------------------------
QuickPdo::setConnection("mysql:dbname=oui;host=127.0.0.1", "root", "root", [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
]);


az(QuickPdoInfoTool::getDatabases(false));
a(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByTable("oui.concours"));
a(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByDatabase("oui"));