<?php

use Core\Services\A;
use Core\Services\X;
use Module\NullosAdmin\ThemeHelper\ThemeHelperInterface;

$theme = X::get('NullosAdmin_themeHelper');
/**
 * @var $theme ThemeHelperInterface
 */
$theme->useLib("bootstrap-progressbar");
$theme->useLib("Chart");
$theme->useLib("flot");
$theme->useLib("dateJS");


A::addBodyEndJsCode('jquery', file_get_contents($v['__DIR__'] . "/init.js"));

?>
<div id="chart_plot_01" class="demo-placeholder"></div>