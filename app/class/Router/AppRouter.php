<?php


namespace Router;


class AppRouter
{


    public static function StaticPageRouter_feedUri2Page(array &$uri2Page)
    {
        $uri2Page["/login"] = "login.php";
    }

    public static function StaticObjectRouter_feedUri2Controller(array &$uri2Controller)
    {
        $uri2Controller["/login"] = "\\Controller\\Admin\\LoginController:render";
        $uri2Controller["/"] = "\\Controller\\Admin\\HomeController:render";
    }
}