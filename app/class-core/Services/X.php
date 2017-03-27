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
 *
 *
 *

 */
class X extends AbstractX
{


//    public static function getStaticPageRouter_StaticPageController()
//    {
//        $o = new \Kamille\Architecture\Controller\Web\StaticPageController();
//        $o->setPagesDir(WebApplication::inst()->get('app_dir') . "/pages");
//        return $o;
//
//    }
//
//
//    public static function getStaticPageRouter_Uri2Page()
//    {
//        $uri2Page = [];
//        Hooks::StaticPageRouter_feedUri2Page($uri2Page);
//        return $uri2Page;
//    }
//
//
//    public static function getStaticObjectRouter_Uri2Controller()
//    {
//        $uri2Controller = [];
//        Hooks::StaticObjectRouter_feedUri2Controller($uri2Controller);
//        return $uri2Controller;
//    }

    //--------------------------------------------
    // BELOW THIS LINE, LET THE BOT DO ITS JOB
    //--------------------------------------------

    protected static function Connexion_foo()
    {
        echo "pouddd";
    }

    protected static function Connexion_doo()
    {
        echo "pou";
    }

	public static function Core_webApplicationConfigurator()
    {
        if (!array_key_exists('Core_webApplicationConfigurator', self::$cache)) {
            self::$cache['Core_webApplicationConfigurator'] = new \Module\Core\ApplicationConfigurator\WebApplicationConfigurator();
        }
        return self::$cache['Core_webApplicationConfigurator'];
    }

	public static function create(){
        return new static();
    }
}