<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$appDir = ApplicationParameters::get('app_dir');

$conf = [
    /**
     * The default controller used by the static router (if no uri matches)
     * hint: WebApplicationHandler
     */
    "defaultController" => 'Controller\Core\CoreDefaultController:render',

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
     * This is the log
     */
    "logFile" => $appDir . "/logs/kamille.log.txt",
];