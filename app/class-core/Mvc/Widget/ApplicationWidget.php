<?php


namespace Core\Mvc\Widget;



use Core\Services\A;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\Widget\Widget;
use Kamille\Mvc\Widget\WidgetInterface;
use Kamille\Services\XLog;

class ApplicationWidget extends Widget{

    /**
     * @return string, the fallback widget content.
     */
    protected function onRenderFailed(\Exception $e, $templateName, WidgetInterface $widget)
    {
        $msg = "Error with rendering of widget " . get_class($widget) . " and template $templateName";
        $log = "Widget: " . $msg . ": " . A::exceptionToString($e);
        XLog::error($log);
        if (true === ApplicationParameters::get("debug")) {
            return "debug: " . $msg;
        }
        return "";
    }

}