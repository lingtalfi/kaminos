<?php


namespace Core\Controller;


use Core\Services\Hooks;
use Core\Services\X;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Architecture\Response\Web\HttpResponseInterface;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XConfig;
use Kamille\Services\XLog;
use Kamille\Utils\Laws\LawsUtilInterface;
use Kamille\Utils\ModuleInstallationRegister\ModuleInstallationRegister;


class ApplicationController extends KamilleController
{

    private $translationContext;


    /**
     * Renders a laws view.
     * More info on laws here: https://github.com/lingtalfi/laws
     *
     * Note: the laws view is provided by the Core module (at least in this implementation),
     * so don't forget to install it if you want to use this method.
     *
     *
     *
     * $config: allows you to override the laws config file on the fly.
     *
     * @return HttpResponseInterface
     */
    protected function renderByViewId($viewId, $config = null, array $options = [])
    {
        if (true === ModuleInstallationRegister::isInstalled('Core')) {


            //--------------------------------------------
            // SEND DEBUG MESSAGE TO THE LOGS
            //--------------------------------------------
            if (true === ApplicationParameters::get('debug')) {
                XLog::debug("[Controller " . get_called_class() . "] - renderByViewId with viewId $viewId");
            }


            //--------------------------------------------
            // CONFIGURING THE LAWS UTIL OPTIONS
            //--------------------------------------------
            if (false === array_key_exists("autoloadCss", $options)) {
                $options['autoloadCss'] = XConfig::get("Core.useCssAutoload", false);
            }
            $options['widgetClass'] = 'Core\Mvc\Widget\ApplicationWidget';


            //--------------------------------------------
            // LET MODULES UPDATE THE LAWS CONFIG
            //--------------------------------------------
            $c = [$this, $config];
            Hooks::call("Core_autoLawsConfig", $c);
            $config = $c[1];


            //--------------------------------------------
            // INJECTING LAZY JS CODE AT THE END OF THE BODY
            //--------------------------------------------
            if (null !== ($coll = X::get("Core_lazyJsInit", null, false))) {
                $options['bodyEndSnippetsCollector'] = $coll;
            }


            //--------------------------------------------
            // RENDER THE CONTENT USING THE LAWS TOOL
            //--------------------------------------------
            /**
             * @var $util LawsUtilInterface
             */
            $util = X::get("Core_lawsUtil");
            $content = $util->renderLawsViewById($viewId, $config, $options);
        } else {
            $content = "";
        }
        return HttpResponse::create($content);

    }


    protected function renderAjaxByViewId($viewId, $config = null, array $options = [])
    {
        if (true === ModuleInstallationRegister::isInstalled('Core')) {


            //--------------------------------------------
            // SEND DEBUG MESSAGE TO THE LOGS
            //--------------------------------------------
            if (true === ApplicationParameters::get('debug')) {
                XLog::debug("[Controller " . get_called_class() . "] - renderAjaxByViewId with viewId $viewId");
            }
            $options['widgetClass'] = 'Core\Mvc\Widget\ApplicationWidget';
            $options['layout'] = 'Kamille\Mvc\Layout\Layout';


            //--------------------------------------------
            // LET MODULES UPDATE THE LAWS CONFIG
            //--------------------------------------------
            $c = [$this, $config];
            Hooks::call("Core_autoLawsConfig", $c);
            $config = $c[1];

            //--------------------------------------------
            // RENDER THE CONTENT USING THE LAWS TOOL
            //--------------------------------------------
            /**
             * @var $util LawsUtilInterface
             */
            $util = X::get("Core_lawsUtil");
            $content = $util->renderLawsViewById($viewId, $config, $options);
        } else {
            $content = "";
        }
        return $content;
    }


    protected function getTranslationContext()
    {
        if (null === $this->translationContext) {
            $s = get_class($this);
            $p = explode('\\', $s);
            array_shift($p); // drop the Controller prefix
            $this->translationContext = 'controllers/' . implode("/", $p);
        }
        return $this->translationContext;
    }

}