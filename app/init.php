<?php


/**
 * This is the init file.
 * It configures the application preferences (just before the application is launched).
 *
 */


use Kamille\Architecture\Environment\Web\Environment;


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





