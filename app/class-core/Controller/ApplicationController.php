<?php


namespace Core\Controller;


use Core\Services\Hooks;
use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Services\XConfig;
use Kamille\Utils\ModuleInstallationRegister\ModuleInstallationRegister;


class ApplicationController extends KamilleController
{

    private $translationContext;


    protected function renderByViewId($viewId, $config = null, array $options = [])
    {


        /**
         * Todo: move the KamilleController.renderByViewId method to a LawsService,
         * and call this service from here (from the application context rather than the framework (aka kamille planet) context).
         * So that in the end we have full hand on the customization of the lawsUtil (as an object)
         *
         */
        if (true === ModuleInstallationRegister::isInstalled('Core')) {

            if (false === array_key_exists("autoloadCss", $options)) {
                $options['autoloadCss'] = XConfig::get("Core.useCssAutoload", false);
            }
            $options['widgetClass'] = 'Core\Mvc\Widget\ApplicationWidget';

            $c = [$this, $config];
            Hooks::call("Core_autoLawsConfig", $c);
            $config = $c[1];
        }

        return parent::renderByViewId($viewId, $config, $options);
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