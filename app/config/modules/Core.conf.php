<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$appDir = ApplicationParameters::get('app_dir');

$conf = [
    /**
     * The default controller called by the static router when no other page matches
     * hint: WebApplicationHandler
     */
    "fallbackController" => 'Controller\Core\PageNotFoundController:render',

    /**
     * The exception controller used when an exception was caught at the
     * WebApplicationHandler level (which is btw a bad thing as it should
     * probably be caught earlier).
     *
     * hint: WebApplicationHandler
     */
    "exceptionController" => 'Controller\Core\ExceptionController:render',

    /**
     * Whether or not to use the default useFileLoggerListener provided by the Core module.
     * It will write logs to the file specified with the logFile parameter
     *
     */
    "useFileLoggerListener" => true,
    /**
     * This is the log file for the core module (which brings up XLog functionality)
     */
    "logFile" => $appDir . "/logs/kamille.log.txt",
    /**
     *
     * Whether or not to show the exception trace in the logs.
     * You can use the H::exceptionToString($e) method.
     */
    "showExceptionTrace" => false,
    /**
     * Whether or not to autoload the css files based on their existence at the location defined
     * in the laws system (part two).
     * https://github.com/lingtalfi/laws
     *
     * Basically, when this is true, you don't need to call the stylesheet from your widget/layout code,
     * this call will be made for you, as long as you create the stylesheet in the right
     * location (defined in laws part 2).
     */
    "useCssAutoload" => true,
];