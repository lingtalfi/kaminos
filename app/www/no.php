<?php

use ApplicationItemManager\Importer\GithubImporter;
use ApplicationItemManager\Installer\KamilleModuleInstaller;
use ApplicationItemManager\Installer\KamilleWidgetInstaller;
use ApplicationItemManager\LingApplicationItemManager;
use ApplicationItemManager\Repository\KamilleModulesRepository;
use ApplicationItemManager\Repository\LingUniverseRepository;
use DirScanner\YorgDirScannerTool;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Mvc\Layout\HtmlLayout;
use Kamille\Mvc\Loader\FileLoader;
use Kamille\Mvc\Renderer\LawsPhpLayoutRenderer;
use Kamille\Mvc\Widget\Widget;
use Output\ProgramOutput;
use Output\WebProgramOutput;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";




//--------------------------------------------
// LAWS: INTRODUCING POSITIONS TO THE LAYOUT-WIDGETS MODEL
//--------------------------------------------
/**
 * The fun thing is that we actually don't change the whole system.
 * Positions are just strings, and they are incorporated in the widgetName.
 *
 * So, a widget name is now as follow:
 *
 * - widgetName: <layoutId> <.> <position> <.> <index>
 * - layoutId: an arbitrary id chosen by the user (for instance: home, product, login, ...)
 * - position: the name of the layout position.
 *              From inside a template, the idea is that you can either use the widget method, or the position method.
 *              The benefit of using positions vs using a widget is that multiple widgets can be bound to a given position.
 * - index: if two widgets
 *
 *
 */
$wloader = FileLoader::create()->addDir(Z::appDir() . "/theme/widget");
$commonRenderer = LawsPhpLayoutRenderer::create();


//HtmlPageHelper::$title = "Coucou";
//HtmlPageHelper::$description = "Ca va ?";
//HtmlPageHelper::css("/styles/style.css");
//HtmlPageHelper::js("/js/lib/mylib.js", "jquery", ["defer" => "true"]);
//HtmlPageHelper::js("/js/poite/poire.js");
//HtmlPageHelper::addBodyClass("marsh");
//HtmlPageHelper::addBodyClass("mallow");
//HtmlPageHelper::addBodyAttribute("onload", "tamere");
//HtmlPageHelper::js("/js/lib/sarah", null, null, false);


echo HtmlLayout::create()
    ->setTemplate("laws_home")
    ->setLoader(FileLoader::create()
        ->addDir(Z::appDir() . "/theme/layout")
    )
    ->setRenderer($commonRenderer)
    ->bindWidget("top.meteo", Widget::create()
        ->setTemplate("meteo/meteo")
        ->setVariables(['level' => "good"])
        ->setLoader($wloader)
        ->setRenderer($commonRenderer)
    )
    ->bindWidget("top.kart", Widget::create()
        ->setTemplate("kart/kart")
        ->setLoader($wloader)
        ->setRenderer($commonRenderer)
    )
    ->render([
        "name" => 'Pierre',
    ]);
