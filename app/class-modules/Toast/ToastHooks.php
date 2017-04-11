<?php


namespace Module\Toast;


class ToastHooks
{


    protected static function StaticPageRouter_feedUri2Page(array &$uri2Page)
    {
        $uri2Page["/toast"] = "toast.php";
        $uri2Page["/"] = "home.php";
    }

    protected static function Core_feedUri2Controller(array &$uri2Controller)
    {
        $uri2Controller["/toast"] = "something";
        $uri2Controller["/marshmallows"] = "something";
    }

}