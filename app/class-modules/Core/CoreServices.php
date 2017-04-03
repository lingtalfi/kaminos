<?php


namespace Module\Core;


class CoreServices
{
    private static $cache;

    protected static function Core_webApplicationHandler()
    {
        if (!array_key_exists('Core_webApplicationHandler', self::$cache)) {
            self::$cache['Core_webApplicationHandler'] = new \Module\Core\ApplicationHandler\WebApplicationHandler();
        }
        return self::$cache['Core_webApplicationHandler'];
    }
}


