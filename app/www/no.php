<?php


use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Utils\Laws\LawsUtil;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";


//a($_POST);
// <meta charset="utf-8" />
HtmlPageHelper::addMeta(["charset" => "utf-8"]);


$viewId = "tuc";
$useCssAutoload = true;
echo LawsUtil::renderLawsViewById($viewId, []);

