<?php


namespace Core\Services;

use Kamille\Services\AbstractHooks;


/**
 * This class is used to hook modules dynamically.
 * This class is written by modules, so, be careful I guess.
 *
 * A hook is always a public static method (in this class)
 *
 *
 * Rules of thumb: you can add new methods, but NEVER REMOVE A METHOD
 * (because you might break a dependency that someone made to this method)
 */
class Hooks extends AbstractHooks
{
//    public static function StaticPageRouter_feedUri2Page(array &$uri2Page)
//    {
//        \Toast\ToastHooks::StaticPageRouter_feedUri2Page($uri2Page);
//        AppRouter::StaticPageRouter_feedUri2Page($uri2Page);
//    }
//
//    public static function StaticObjectRouter_feedUri2Controller(array &$uri2Controller)


//    {
//        AppRouter::StaticObjectRouter_feedUri2Controller($uri2Controller);
//    }





	protected static function Core_feedUri2Controller(array &$uri2Controller)
	{
		// mit-start:Toast
		$uri2Controller["/toast"] = "something";
        $uri2Controller["/marshmallows"] = "something";
		// mit-end:Toast
	}

	protected static function Core_addLoggerListener(\Logger\LoggerInterface $logger)
	{
		if (true === \Kamille\Services\XConfig::get("Core.useFileLoggerListener")) {
            $f = \Kamille\Services\XConfig::get("Core.logFile");
            $logger->addListener(\Logger\Listener\FileLoggerListener::create()
                ->setFormatter(\Logger\Formatter\TagFormatter::create())
                ->setIdentifiers(null)
                ->setPath($f));
        }
	}

	protected static function Core_feedEarlyRouter(\Module\Core\Architecture\Router\EarlyRouter $router)
	{
		// mit-start:Authenticate
		$router->addRouter(\Module\Authenticate\Architecture\Router\AuthenticateRouter::create());
		// mit-end:Authenticate
	}

	// 68
    // 72
}

