<?php


namespace Router;


class AppRouter{


    public static function StaticPageRouter_feedRequestUri(array &$uri2Page){
        $uri2Page["/login"] = "login.php";
    }
}