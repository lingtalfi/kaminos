<?php


namespace Core\Services;

use Authenticate\Grant\Exception\GrantException;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Services\XConfig;
use Kamille\Services\XLog;
use PersistentRowCollection\Finder\PersistentRowCollectionFinderInterface;
use PersistentRowCollection\InteractivePersistentRowCollectionInterface;
use PersistentRowCollection\PersistentRowCollectionInterface;


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


    public static function has($badge, $throwEx = false)
    {
        if (null !== ($grantor = X::get("Authenticate_grantor", null, false))) {
            /**
             * @var $grantor \Authenticate\Grant\GrantorInterface
             */
            if (true === $grantor->has($badge)) {
                return true;
            }
        }
        if (true === $throwEx) {
            throw new GrantException("You don't have the necessary privilege to do this action ($badge)");
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

    /**
     * @return InteractivePersistentRowCollectionInterface|false
     * @throws \Exception
     */
    public static function getPrc($prcId, $checkInteractive = true, $throwEx = true)
    {
        /**
         * @var $finder PersistentRowCollectionFinderInterface
         */
        $finder = X::get("Core_PersistentRowCollectionFinder");
        if (false !== ($prc = $finder->find($prcId))) {
            if (false === $checkInteractive) {
                return $prc;
            } else {
                if ($prc instanceof InteractivePersistentRowCollectionInterface) {
                    return $prc;
                } else {
                    $msg = "Prc class not an instance of InteractivePersistentRowCollectionInterface, prcId=$prcId";
                    if (true === ApplicationParameters::get("debug")) {
                        XLog::error($msg);
                    }
                    if (true === $throwEx) {
                        throw new \Exception($msg);
                    }
                    return false;
                }
            }

        }
        $msg = "Prc not found with prcId=$prcId";
        if (true === ApplicationParameters::get("debug")) {
            XLog::error($msg);
        }
        if (true === $throwEx) {
            throw new \Exception($msg);
        }
        return false;
    }


    public static function prcLink($prcId, $type = "list")
    {
        return XConfig::get("NullosAdmin.uriCrud") . "?type=$type&prc=$prcId";
    }
}