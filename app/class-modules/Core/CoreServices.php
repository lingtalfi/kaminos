<?php


namespace Module\Core;


class CoreServices
{

    protected static function Core_webApplicationHandler()
    {
        return new \Module\Core\ApplicationHandler\WebApplicationHandler();
    }
}


