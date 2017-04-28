<?php


namespace Module\Core\Pdo;

use Kamille\Services\XConfig;
use Kamille\Services\XLog;
use QuickPdo\QuickPdo;

/**
 * This class just loads a QuickPdo instance.
 */
class QuickPdoInitializer
{

    private $initialized;


    public function __construct()
    {
        $this->initialized = false;
    }

    public function init()
    {
        if (false === $this->initialized) {
            $c = XConfig::get("Core.quickPdoConfig");
            QuickPdo::setConnection($c['dsn'], $c['user'], $c['pass'], $c['options']);
            QuickPdo::setOnQueryReadyCallback(function ($query, $markers = null) {
                XLog::log(new QuickPdoQueryFormatter($query, $markers), 'sql.log');
            });
            $this->initialized = true;
        }
    }

}