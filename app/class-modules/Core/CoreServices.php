<?php


namespace Module\Core;


class CoreServices
{

    protected static function Core_webApplicationHandler()
    {
        return new \Module\Core\ApplicationHandler\WebApplicationHandler();
    }

    /**
     * This service will always return an instance of the LawsUtil object.
     * Happy coding!
     */
    protected static function Core_lawsUtil()
    {
        $layoutProxy = \Kamille\Mvc\LayoutProxy\LawsLayoutProxy::create();
        \Core\Services\Hooks::call("Core_addLawsUtilProxyDecorators", $layoutProxy);
        return \Kamille\Utils\Laws\LawsUtil::create()
            ->setLawsLayoutProxy($layoutProxy);

    }


    protected static function Core_lazyJsInit()
    {
        $collector = \Module\Core\JsLazyCodeCollector\JsLazyCodeCollector::create();
        \Core\Services\Hooks::call("Core_lazyJsInit_addCodeWrapper", $collector);
        return $collector;
    }

    protected static function Core_QuickPdoInitializer()
    {
        $initializer = new \Module\Core\Pdo\QuickPdoInitializer();
        return $initializer;
    }
}


