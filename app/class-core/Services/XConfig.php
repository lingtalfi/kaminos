<?php


namespace Core\Services;


use Core\Services\Exception\CoreServicesException;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

class XConfig
{

    /**
     * @var array of module names => configuration parameters
     *          configuration parameters: key => value
     *
     */
    private static $confs = [];


    /**
     * @param $key :
     *      key: <module> <.> <moduleKey>
     *
     * For instance: Core.paramOne
     *
     */
    public static function get($key, $default = null, $throwEx = false)
    {
        $p = explode('.', $key, 2);
        if (2 === count($p)) {
            $module = $p[0];
            $parameter = $p[1];


            if (false === array_key_exists($module, self::$confs)) {
                $appDir = ApplicationParameters::get('app_dir');
                $modConfFile = $appDir . "/config/modules/$module.conf.php";
                $conf = [];
                if (file_exists($modConfFile)) {
                    include $modConfFile;

                }
                self::$confs[$module] = $conf;
            }

            if (array_key_exists($parameter, self::$confs[$module])) {
                return self::$confs[$module][$parameter];
            }
        } else {
            if (true === $throwEx) {
                throw new CoreServicesException("Invalid parameter syntax: $key");
            }
        }
        if (true === $throwEx) {
            throw new CoreServicesException("Parameter not found: $key");
        }
        return $default;
    }
}