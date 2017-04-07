<?php


namespace Core\Services;

use Kamille\Services\XConfig;


/**
 * H is my personal helper at the application level.
 * You can use it if you want (obviously).
 *
 * It provides some methods I found useful to have and didn't know where else to put them.
 *
 */
class A
{
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
}