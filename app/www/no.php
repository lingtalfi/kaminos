<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Mvc\Layout\HtmlLayout;
use Kamille\Mvc\LayoutProxy\LawsLayoutProxy;
use Kamille\Mvc\Loader\FileLoader;
use Kamille\Mvc\Position\Position;
use Kamille\Mvc\Renderer\PhpLayoutRenderer;
use Kamille\Mvc\Widget\Widget;
use Logger\Listener\FileLoggerListener;
use Logger\Logger;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";


$appDir = ApplicationParameters::get("app_dir");
$f = $appDir . "/logs/kamille.log.txt";
$log = Logger::create()->addListener(FileLoggerListener::create()->setPath($f)->setIdentifiers(['info']));

$log->log("Hello log", "info");
