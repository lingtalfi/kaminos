<?php


namespace Controller;


use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Controller\ControllerInterface;
use Kamille\Ling\Z;
use Kamille\Mvc\Layout\Layout;
use Kamille\Mvc\LayoutProxy\DebugLayoutProxy;
use Kamille\Mvc\Loader\FileLoader;
use Kamille\Mvc\Renderer\PhpLayoutRenderer;

/**
 *
 * This controller uses the mvc pattern and implements the notion of theme (as defined in the kam framework).
 * It works only in a themable application (as defined in the kamille framework).
 *
 */
class ThemableController implements ControllerInterface
{


    protected function renderLayout($templateName)
    {
        $commonRenderer = $this->getRenderer();
        echo Layout::create()
            ->setTemplate($templateName)
            ->setLoader(FileLoader::create()
                ->addDir(Z::appDir() . "/theme/" . WebApplication::inst()->get('theme') . "/layout")
            )
            ->setRenderer($commonRenderer)
            ->render();
    }


    protected function getRenderer()
    {
        return PhpLayoutRenderer::create()->setLayoutProxy(DebugLayoutProxy::create());
    }
}