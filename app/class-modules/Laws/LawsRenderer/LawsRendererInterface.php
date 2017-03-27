<?php


namespace Module\Laws\LawsRenderer;


use Kamille\Architecture\Response\Web\HttpResponseInterface;

interface LawsRendererInterface{


    /**
     * @return HttpResponseInterface
     *
     * widgetsConf: array of widgetClassName => conf
     *
     *
     */
    public function render($layoutId, array $layoutConf=null, array $widgetsConf=null);
}