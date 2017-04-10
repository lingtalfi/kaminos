<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XConfig;
use Kamille\Utils\Laws\LawsUtil;
use Logger\Formatter\TagFormatter;
use Logger\Listener\FileLoggerListener;
use Logger\Logger;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";





//a($_POST);
// <meta charset="utf-8" />
HtmlPageHelper::addMeta(["charset" => "utf-8"]);


$viewId = "tuc";
$useCssAutoload = true;
echo LawsUtil::renderLawsViewById($viewId, []);

