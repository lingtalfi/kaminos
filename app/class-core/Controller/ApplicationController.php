<?php


namespace Core\Controller;


use Core\Services\Hooks;
use Core\Services\X;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Architecture\Response\Web\HttpResponseInterface;
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
     *
     * $config: allows you to override the laws config file on the fly.
     *
     * @return HttpResponseInterface
     */
    protected function renderByViewId($viewId, $config = null, array $options = [])
    {
        if (true === ModuleInstallationRegister::isInstalled('Core')) {

            if (false === array_key_exists("autoloadCss", $options)) {
                $options['autoloadCss'] = XConfig::get("Core.useCssAutoload", false);
            }
            $options['widgetClass'] = 'Core\Mvc\Widget\ApplicationWidget';

            $c = [$this, $config];
            Hooks::call("Core_autoLawsConfig", $c);
            $config = $c[1];


            if (true === ApplicationParameters::get('debug')) {
                XLog::debug("[Controller " . get_called_class() . "] - renderByViewId with viewId $viewId");
            }

            $util = X::get("Core_lawsUtil");
            /**
             * @var $util LawsUtilInterface
             */
            $content = $util->renderLawsViewById($viewId, $config, $options);
        } else {
            $content = "";
        }
        return HttpResponse::create($content);


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