<?php


namespace Module\NullosAdmin;


class NullosAdminHooks
{

    /**
     * @param data , array:
     *      - 0: controller instance
     *      - 1: laws config
     */
    protected static function Core_autoLawsConfig(&$data)
    {
        $autoJsScript = "/theme/" . \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("theme") . "/controllers/" . \Bat\ClassTool::getShortName($data[0]) . ".js";
        $file = \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("app_dir") . "/www" . $autoJsScript;
        if (file_exists($file)) {
            $data[1]['layout']['conf']["jsScripts"][] = $autoJsScript;
        }
    }

    protected static function Core_addLawsUtilProxyDecorators(\Kamille\Mvc\LayoutProxy\LawsLayoutProxyInterface $layoutProxy)
    {
        if ($layoutProxy instanceof \Kamille\Mvc\LayoutProxy\LawsLayoutProxy) {
            $layoutProxy->addDecorator(\Kamille\Mvc\WidgetDecorator\Bootstrap3GridWidgetDecorator::create());
        }
    }
}

