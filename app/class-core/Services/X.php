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






















    public static function UploadProfile_profileFinder()
    {
        $appDir = \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("app_dir");
        $finder = \Module\UploadProfile\ProfileFinder\FileProfileFinder::create()->setProfilesDir($appDir . "/config/upload-profiles");
        return $finder;
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

    public static function Core_QuickPdoInitializer()
    {
        $initializer = new \Module\Core\Pdo\QuickPdoInitializer();
        return $initializer;
    }

    public static function Core_PersistentRowCollectionFinder()
    {
        $initializer = new \Core\Framework\PersistentRowCollection\Finder\PersistentRowCollectionFinder();
        return $initializer;
    }

    public static function Core_LawsViewRenderer()
    {
        $r = new \Module\Core\Utils\Laws\LawsViewRenderer();
        return $r;
    }

    public static function NullosAdmin_themeHelper()
    {
        return \Module\NullosAdmin\ThemeHelper\ThemeHelper::inst();
    }

    public static function DataTable_profileFinder()
    {
        $appDir = \Kamille\Ling\Z::appDir();
        $f = \Module\DataTable\DataTableProfileFinder\DataTableProfileFinder::create();
        $f->setProfilesDir($appDir . "/config/datatable-profiles");
        \Core\Services\Hooks::call("DataTable_configureProfileFinder", $f);
        return $f;
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

    protected static function Core_RoutsyRouter()
    {
        $routsyRouter = \Kamille\Utils\Routsy\RoutsyRouter::create();
        $routsyRouter
            ->addCollection(\Kamille\Utils\Routsy\RouteCollection\RoutsyRouteCollection::create()->setFileName("routes"))
            ->addCollection(\Kamille\Utils\Routsy\RouteCollection\PrefixedRoutsyRouteCollection::create()
                ->setFileName("back")
                ->setOnRouteMatch(function () {
                    \Kamille\Architecture\ApplicationParameters\ApplicationParameters::set("theme", \Kamille\Services\XConfig::get("Core.themeBack"));
                })
                ->setUrlPrefix(\Kamille\Services\XConfig::get("Core.uriPrefixBackoffice"))
            );
        \Core\Services\Hooks::call("Core_configureRoutsyRouter", $routsyRouter);
        return $routsyRouter;
    }




































































































}