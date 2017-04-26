<?php

use Core\Services\A;
use Core\Services\X;
use Module\NullosAdmin\ThemeHelper\ThemeHelperInterface;

$theme = X::get('NullosAdmin_themeHelper');
/**
 * @var $theme ThemeHelperInterface
 */

$theme->useLib("flot");
$theme->useLib("dateJS");
$theme->useLib("bootstrap-daterangepicker");

A::addBodyEndJsCode('jquery', file_get_contents($v['__DIR__'] . "/init.js"));

?>
<div class="row x_title">
    <div class="col-md-6">
        <h3>Network Activities <small>Graph title sub-title</small></h3>
    </div>
    <div class="col-md-6">
        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
        </div>
    </div>
</div>
<div id="chart_plot_01" class="demo-placeholder"></div>