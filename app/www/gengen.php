<?php


use ArrayToString\ArrayToStringTool;
use CrudGeneratorTools\GeneratorGenerator\GeneratorGenerator;
use QuickPdo\QuickPdo;
use QuickPdo\QuickPdoInfoTool;

require_once __DIR__ . "/../boot.php";

ini_set('display_errors', "1");

//--------------------------------------------
// GENERATOR GENERATOR EXAMPLE
//--------------------------------------------
QuickPdo::setConnection("mysql:dbname=zilu;host=127.0.0.1", "root", "root", [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
]);


//az(QuickPdoInfoTool::getDatabases(false));
//a(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByTable("oui.concours"));
//a(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByDatabase("oui"));


//az(QuickPdoInfoTool::getDatabases(false));
//a(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByTable("zilu.container"));
//a(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByDatabase("zilu"));


/**
 * Generating foreign key preferred columns,
 * execute this in a browser
 * and paste the result in a class of yours, inside a getForeignKeysPreferredColumns (or similar) method.
 */
echo nl2br(ArrayToStringTool::toPhpArray(GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByDatabase("zilu")));
