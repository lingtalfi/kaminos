<?php


namespace Module\Core\JsLazyCodeCollector;


interface JsLazyCodeCollectorInterface
{

    /**
     * @param $groupId : string|null, an identifier indicating which group the code should be wrapped into
     * For more details about this method, please check the doc for the
     * Core_lazyJsInit service, which this class is the "client" of.
     */
    public function addJsCode($groupId, $code);

    public function getCompiledJsCode();

    public function addCodeWrapper($groupId, callable $wrapper);
}