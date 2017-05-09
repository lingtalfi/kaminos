<?php


namespace Module\AutoAdmin;


use Kamille\Ling\Z;

class AutoAdminHelper
{

    public static function getGeneratedSideBarMenuPath()
    {
        return Z::appDir() . "/store/AutoAdmin/sideBarMenu/generated.sideBarMenu.php";
    }

    public static function getGeneratedPrcPath($moduleName)
    {
        return Z::appDir() . "/class-prc/$moduleName/Auto";
    }
}


