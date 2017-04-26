<?php


namespace Core\Services;


use Kamille\Services\AbstractX;


/**
 *
 * Service container of the application.
 * It contains the services of the application.
 *
 * Services can be added manually or by automates.
 *
 *
 * Rules of thumb: you can add new methods, but NEVER REMOVE A METHOD
 * (because you might break a dependency that someone made to this method)
 *
 *
 * Note1: remember that this class belongs to the application,
 * so don't hesitate to use it how you like (use php constants if you want).
 * You would just throw it away and restart for a new application, no big deal.
 *
 *
 * Note2: please avoid use statements at the top of this file.
 * I have no particular arguments why, but it makes my head cleaner to
 * see a clean top of the file, thank you by advance, ling.
 *
 *
 */
class X extends AbstractX
{
    //--------------------------------------------
    // BELOW THIS LINE ARE MODULES SERVICES, LET THE BOT DO ITS JOB
    //--------------------------------------------







    public static function Authenticate_test($name, $pass)
    {
        a($name, $pass);
    }



    public static function Test_mymethodfff()
    {
        // pou
    }


    public static function Authenticate_userStore()
    {
        $f = \Kamille\Services\XConfig::get("Authenticate.pathUserStore");
        return \Authenticate\UserStore\FileUserStore::create()->setFile($f);
    }

    public static function Authenticate_badgeStore()
    {
        $f = \Kamille\Services\XConfig::get("Authenticate.pathBadgeStore");
        return \Authenticate\BadgeStore\FileBadgeStore::create()->setFile($f);
    }

    public static function Authenticate_grantor()
    {
        $badgeStore = \Core\Services\X::get(\Kamille\Services\XConfig::get("Authenticate.serviceBadgeStore"));
        $grantor = \Authenticate\Grant\Grantor::create()->setBadgeStore($badgeStore);
        return $grantor;
    }






    public static function Core_webApplicationHandler()
    {
        return new \Module\Core\ApplicationHandler\WebApplicationHandler();
    }

    public static function Core_lawsUtil()
    {
        $layoutProxy = \Kamille\Mvc\LayoutProxy\LawsLayoutProxy::create();
        \Core\Services\Hooks::call("Core_addLawsUtilProxyDecorators", $layoutProxy);
        return \Kamille\Utils\Laws\LawsUtil::create()
            ->setLawsLayoutProxy($layoutProxy);

    }

    public static function Core_lazyJsInit()
    {
        $collector = \Module\Core\JsLazyCodeCollector\JsLazyCodeCollector::create();
        \Core\Services\Hooks::call("Core_lazyJsInit_addCodeWrapper", $collector);
        return $collector;
    }

    public static function NullosAdmin_themeHelper()
    {
        return \Module\NullosAdmin\ThemeHelper\ThemeHelper::create();
    }










































































}