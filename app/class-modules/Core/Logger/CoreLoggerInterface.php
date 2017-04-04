<?php


namespace Module\Core\Logger;


use Logger\Listener\LoggerListenerInterface;

interface CoreLoggerInterface
{
    public function fatal($msg);

    public function error($msg);

    public function warn($msg);

    public function info($msg);

    public function debug($msg);

    public function trace($msg);

    public function log($msg, $identifier);

    public function addListener(LoggerListenerInterface $listener);
}