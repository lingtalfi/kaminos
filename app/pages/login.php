<?php


use Kamille\Ling\Z;
use Kamille\Mvc\Layout\Layout;
use Kamille\Mvc\LayoutProxy\DebugLayoutProxy;
use Kamille\Mvc\Loader\FileLoader;
use Kamille\Mvc\Renderer\PhpLayoutRenderer;

require_once __DIR__ . "/../init.php";


//$wloader = FileLoader::create()->addDir(Z::appDir() . "/theme/widget");
$commonRenderer = PhpLayoutRenderer::create()->setLayoutProxy(DebugLayoutProxy::create());


echo Layout::create()
    ->setTemplate("login")
    ->setLoader(FileLoader::create()
        ->addDir(Z::appDir() . "/theme/gentelella/layout")
    )
    ->setRenderer($commonRenderer)
    ->render([
        "name" => 'Pierre',
    ]);




