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
}