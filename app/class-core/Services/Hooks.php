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


    protected static function Test_feedUri2Controller(array &$uri2Controller)
    {
        $uri2Controller["/login"] = "something";
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

	protected static function Core_autoLawsConfig(&$data)
	{
		// mit-start:NullosAdmin
		$autoJsScript = "/theme/" . \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("theme") . "/controllers/" . \Bat\ClassTool::getShortName($data[0]) . ".js";
        $file = \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("app_dir") . "/www" . $autoJsScript;
        if (file_exists($file)) {
            $data[1]['layout']['conf']["jsScripts"][] = $autoJsScript;
        }
		// mit-end:NullosAdmin
	}





}

