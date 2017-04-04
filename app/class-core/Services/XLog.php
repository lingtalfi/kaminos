<?php


namespace Core\Services;

use Kamille\Architecture\Environment\Web\Environment;


/**
 * If you want, you can use this system for identifier names (taken from the log4j framework):
 *
 * - fatal: Designates very severe error events that will presumably lead the application to abort.
 * - error: Designates error events that might still allow the application to continue running.
 * - warn: Designates potentially harmful situations.
 * - info: Designates informational messages that highlight the progress of the application at coarse-grained level.
 * - debug: Designates fine-grained informational events that are most useful to debug an application.
 * - trace: Designates finer-grained informational events than the "debug".
 *
 */
class XLog
{

    private static $observers;

    public static function log($msg, $identifier = null)
    {
        self::prepare();
        if ('dev' === Environment::getEnvironment()) {
            $identifier = self::identifierToString($identifier);
            a($identifier . $msg);
        }
    }


    public static function fatal($msg)
    {
        self::log($msg, 'fatal');
    }

    public static function error($msg)
    {
        self::log($msg, 'error');
    }

    public static function warn($msg)
    {
        self::log($msg, 'warn');
    }

    public static function info($msg)
    {
        self::log($msg, 'info');
    }

    public static function debug($msg)
    {
        self::log($msg, 'debug');
    }

    public static function trace($msg)
    {
        self::log($msg, 'trace');
    }

    //--------------------------------------------
    //
    //--------------------------------------------



    //--------------------------------------------
    //
    //--------------------------------------------
    private static function identifierToString($identifier)
    {
        if (null === $identifier) {
            return "";
        }
        return "[" . strtoupper($identifier) . "]: ";
    }

    private static function prepare()
    {
        if (null === self::$observers) {



            self::$observers = [];
        }
    }
}