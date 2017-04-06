<?php


namespace Core\Controller;


use Kamille\Architecture\Controller\Web\KamilleController;
use Kamille\Services\XConfig;


class ApplicationController extends KamilleController
{
    protected function renderByViewId($viewId, array $config = [])
    {
        $useCssAutoload = XConfig::get("Core.useCssAutoload", false);
        return parent::renderByViewId($viewId, $config, $useCssAutoload);
    }


}