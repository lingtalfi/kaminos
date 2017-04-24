<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Mvc\LayoutProxy\LawsLayoutProxy;
use Kamille\Mvc\WidgetDecorator\GridWidgetDecorator;
use Kamille\Mvc\WidgetDecorator\PositionWidgetDecorator;
use Kamille\Utils\Laws\LawsUtil;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";





$viewId = "test";
$options = [];
$config = [];
$decorator = GridWidgetDecorator::create();
$layoutProxy = LawsLayoutProxy::create()
    ->addDecorator(PositionWidgetDecorator::create())
    ->addDecorator($decorator)
;
echo LawsUtil::create()
    ->setLawsLayoutProxy($layoutProxy)
    ->renderLawsViewById($viewId, $config, $options);