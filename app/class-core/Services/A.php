<?php


namespace Core\Services;

use Kamille\Services\XConfig;


/**
 * This class contains shortcuts to modules services,
 * and to modules related functions.
 *
 */
class A
{

    /**
     * When you log an exception, you can use this method to alter the form of the exception: --whether or
     * not to show the trace--
     *
     */
    public static function exceptionToString(\Exception $e)
    {
        $trace = XConfig::get("Core.showExceptionTrace", false);
        if (true === $trace) {
            return (string)$e;
        }
        $s = (string)$e;
        $p = explode(PHP_EOL, $s, 2);
        return $p[0];
    }


    public static function has()
    {
        /**
         * Todo: privilege framework: has right to do something
         */
    }
}