<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Utils\Laws\LawsUtil;
use Logger\Formatter\TagFormatter;
use Logger\Listener\FileLoggerListener;
use Logger\Logger;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";





$viewId = "tuc";
$useCssAutoload = true;
echo LawsUtil::renderLawsViewById($viewId, [], $useCssAutoload);

