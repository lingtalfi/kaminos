<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Environment\Web\Environment;

$appDir = ApplicationParameters::get('app_dir');


$env = Environment::getEnvironment();


$dbName = "kamille";


if ('dev' === $env) {

    $quickPdoConf = [
        "dsn" => "mysql:dbname=$dbName;host=127.0.0.1",
        "user" => "root",
        "pass" => "root",
        "options" => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ],
    ];
} else {
    $quickPdoConf = [
        "dsn" => "mysql:dbname=$dbName;host=127.0.0.1",
        "user" => "root",
        "pass" => "root",
        "options" => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ],
    ];
}


$conf = [
    /**
     * check documentation for more info
     */
    "exceptionController" => 'Controller\Core\ExceptionController:render',
    "useFileLoggerListener" => true,
    "logFile" => $appDir . "/logs/kamille.log.txt",
    "showExceptionTrace" => false,
    "useCssAutoload" => true,
    //--------------------------------------------
    // DATABASE
    //--------------------------------------------
    "database" => $dbName,
    "useDbLoggerListener" => true,
    "dbLogFile" => $appDir . "/logs/kamille.sql.log.txt",
    "useQuickPdo" => true,
    "quickPdoConfig" => $quickPdoConf,
    //--------------------------------------------
    // JS
    //--------------------------------------------
    "addJqueryEndWrapper" => true,
];