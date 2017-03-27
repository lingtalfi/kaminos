<?php


namespace Module\Laws\LawsRenderer;


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Architecture\Response\Web\HttpResponseInterface;
use Kamille\Ling\Z;
use Kamille\Mvc\Layout\Layout;
use Kamille\Mvc\LayoutProxy\DebugLayoutProxy;
use Kamille\Mvc\Loader\FileLoader;
use Kamille\Mvc\Renderer\PhpLayoutRenderer;
use Kamille\Mvc\Widget\Widget;
use Module\Laws\LawsRenderer\Exception\LawsRendererException;

class LawsRenderer implements LawsRendererInterface
{


    /**
     * @return HttpResponseInterface
     *
     * widgetsConf: array of widgetClassName => conf
     *
     *
     */
    public function render($layoutId, array $layoutConf = null, array $widgetsConf = null)
    {
        $appDir = ApplicationParameters::get('app_dir');
        $confFile = $appDir . "/config/modules/laws/$layoutId.conf.php";
        if (file_exists($confFile)) {
            $conf = [];
            include $confFile;
//            $this->checkConf($conf);

            $layoutInfo = $conf['layouts'][$layoutId];
            $model = $layoutInfo['model'];
            $template = $layoutInfo['template'];
            $layoutConf = $layoutInfo['conf'];
            $widgets = $layoutInfo['widgets'];


            $layout = Layout::create()
                ->setTemplate($template)
                ->setLoader(FileLoader::create()
                    ->addDir(Z::appDir() . "/theme/" . ApplicationParameters::get('theme') . "/layout/$model")
                )
                ->setRenderer($this->getRenderer());

            foreach ($widgets as $id => $widgetConf) {
                $class = $widgetConf['class'];
                $template = $widgetConf['template'];
                $conf = $widgetConf['conf'];


                $widget = Widget::create()
                    ->setTemplate($template)
                    ->setVariables($conf)
                    ->setLoader(FileLoader::create()
                        ->addDir(Z::appDir() . "/theme/" . ApplicationParameters::get('theme') . "/widget/$class")
                    );

            }


            /**
             * Maybe we don't need the model-positions definitions:
             * it's just informative data, it's not strictly required...
             * Todo: remove the model-positions system if not required
             * Note: the model is useful for the loader, but maybe the positions map is still useless...
             *
             */
            return HttpResponse::create($layout->render($layoutConf));
        } else {
            $this->error("config not found for layoutId: $layoutId");
        }
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getRenderer()
    {
        return PhpLayoutRenderer::create()->setLayoutProxy(DebugLayoutProxy::create());
    }

    //--------------------------------------------
    //
    //--------------------------------------------
//    private function checkConf(array $conf)
//    {
//
//        $missingKeys = [];
//        if (!array_key_exists("models", $conf)) {
//            $missingKeys[] = "models";
//        }
//        if (!array_key_exists("layouts", $conf)) {
//            $missingKeys[] = "layouts";
//        }
//        if (!array_key_exists("widgets", $conf)) {
//            $missingKeys[] = "widgets";
//        }
//        if (count($missingKeys) > 0) {
//            throw new LawsRendererException("invalid configuration array: the following keys are missing: " . implode(", ", $missingKeys));
//        }
//    }

    private function error($msg)
    {
        throw new LawsRendererException($msg);
    }
}