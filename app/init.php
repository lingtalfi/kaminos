<?php


/**
 * Welcome to the init file.
 * =============================
 *
 * The init file is responsible for setting the environment in which the app
 * will be executed.
 */


use BumbleBee\Autoload\ButineurAutoloader;
use Kamille\Architecture\Environment\Web\Environment;


//------------------------------------------------------------------------------/
// AUTOLOADER
//------------------------------------------------------------------------------/
/**
 * In this section, we create the necessary autoloaders for our application.
 * By default, I'm using the universe autoloader (bigbang).
 *
 */
require_once __DIR__ . '/class-planets/BumbleBee/Autoload/BeeAutoloader.php';
require_once __DIR__ . '/class-planets/BumbleBee/Autoload/ButineurAutoloader.php';
ButineurAutoloader::getInst()
    ->addLocation(__DIR__ . "/class")
    ->addLocation(__DIR__ . "/class-core")
    ->addLocation(__DIR__ . "/class-modules")
    ->addLocation(__DIR__ . "/class-planets");
ButineurAutoloader::getInst()->start();
// require_once __DIR__ . '/vendor/autoload.php';



//--------------------------------------------
// FUNCTIONS
//--------------------------------------------
require_once __DIR__ . "/functions/main-functions.php";






$environment = Environment::getEnvironment();


//--------------------------------------------
// PHP CONF
//--------------------------------------------
/**
 * In this section, we configure php.
 * Put any directives you like here.
 */
if ('dev' === $environment) {
    ini_set("display_errors", "1");
} else {
    ini_set("display_errors", "0");
}





