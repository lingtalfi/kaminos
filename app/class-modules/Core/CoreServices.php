<?php


namespace Module\Core;






class CoreServices
{
    public static function create(){
        return new static();
    }
    private static $cache;

    protected static function Core_webApplicationConfigurator()
    {
        if (!array_key_exists('Core_webApplicationConfigurator', self::$cache)) {
            self::$cache['Core_webApplicationConfigurator'] = new \Module\Core\ApplicationConfigurator\WebApplicationConfigurator();
        }
        return self::$cache['Core_webApplicationConfigurator'];
    }
}


