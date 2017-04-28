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


    public static function has($badge)
    {
        if (null !== ($grantor = X::get("Authenticate_grantor", null, false))) {
            /**
             * @var $grantor \Authenticate\Grant\GrantorInterface
             */
            return $grantor->has($badge);
        }
        return false;
    }


    public static function addBodyEndJsCode($groupId, $code)
    {
        if (null !== ($coll = X::get("Core_lazyJsInit", null, false))) {
            /**
             * @var $coll \Module\Core\JsLazyCodeCollector\JsLazyCodeCollectorInterface
             */
            return $coll->addJsCode($groupId, $code);
        }
        return false;
    }

    public static function quickPdoInit()
    {
        if (null !== ($obj = X::get("Core_QuickPdoInitializer", null, false))) {
            /**
             * @var $obj \Module\Core\Pdo\QuickPdoInitializer
             */
            $obj->init();
            return true;
        }
        return false;
    }
}