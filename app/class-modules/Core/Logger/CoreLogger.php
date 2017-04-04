<?php


namespace Module\Core\Logger;


use Core\Services\Hooks;
use Logger\Listener\LoggerListenerInterface;
use Logger\Logger;
use Logger\LoggerInterface;

class CoreLogger implements CoreLoggerInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;
    private $isPrepared;


    public function __construct()
    {
        $this->isPrepared = false;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    public function fatal($msg)
    {
        $this->log($msg, "fatal");
    }

    public function error($msg)
    {
        $this->log($msg, "error");
    }

    public function warn($msg)
    {
        $this->log($msg, "warn");
    }

    public function info($msg)
    {
        $this->log($msg, "info");
    }

    public function debug($msg)
    {
        $this->log($msg, "debug");
    }

    public function trace($msg)
    {
        $this->log($msg, "trace");
    }

    public function log($msg, $identifier)
    {
        $this->getLogger()->log($msg, $identifier);
    }

    public function addListener(LoggerListenerInterface $listener)
    {
        $this->getLogger()->addListener($listener);
        return $this;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    private function getLogger()
    {
        if (null === $this->logger) {
            $this->logger = Logger::create();

            if (false === $this->isPrepared) {
                $this->isPrepared = true;
                Hooks::call("Core_addLoggerListener", $this);
            }
        }

        return $this->logger;
    }
}