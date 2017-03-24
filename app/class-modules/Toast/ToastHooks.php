<?php


namespace Module\Toast;


class ToastHooks
{


    public static function StaticPageRouter_feedUri2Page(array &$uri2Page)
    {
        $uri2Page["/toast"] = "toast.php";
        $uri2Page["/"] = "home.php";
    }
}