<?php


namespace Module\Core\JsLazyCodeCollector;


use Kamille\Mvc\BodyEndSnippetsCollector\BodyEndSnippetsCollectorInterface;

interface JsLazyCodeCollectorInterface extends BodyEndSnippetsCollectorInterface
{

    /**
     * @param $groupId : string|null, an identifier indicating which group the code should be wrapped into
     * For more details about this method, please check the doc for the
     * Core_lazyJsInit service, which this class is the "client" of.
     */
    public function addJsCode($groupId, $code);

    public function addCodeWrapper($groupId, callable $wrapper);
}