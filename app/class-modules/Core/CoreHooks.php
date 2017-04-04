<?php


namespace Module\Core;




class CoreHooks
{

    protected static function Core_feedUri2Controller(array &$uri2Controller)
    {

    }

    protected static function Core_addLoggerListener(\Module\Core\Logger\CoreLoggerInterface $coreLogger)
    {
        if (true === \Kamille\Services\XConfig::get("Core.useFileLoggerListener")) {
            $f = \Kamille\Services\XConfig::get("Core.logFile");
            $coreLogger->addListener(\Logger\Listener\FileLoggerListener::create()
                ->setFormatter(\Logger\Formatter\TagFormatter::create())
                ->setIdentifiers(null)
                ->setPath($f));
        }
    }
}


