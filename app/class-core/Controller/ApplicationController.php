<?php


namespace Core\Controller;


use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Services\XConfig;


class ApplicationController extends KamilleController
{
    protected function renderByViewId($viewId, $config = null, array $options = [])
    {


        if (false === array_key_exists("autoloadCss", $options)) {
            $options['autoloadCss'] = XConfig::get("Core.useCssAutoload", false);
        }
        $options['widgetClass'] = 'Core\Mvc\Widget\ApplicationWidget';
        return parent::renderByViewId($viewId, $config, $options);
    }


}