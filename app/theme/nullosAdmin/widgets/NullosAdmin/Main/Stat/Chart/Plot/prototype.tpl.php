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
<div class="x_panel">
    <div class="x_title">
        <h2>Transaction Summary
            <small>Weekly progress</small>
        </h2>
        <div class="filter">
            <div id="reportrange" class="pull-right"
                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="demo-container" style="height:280px">
            <div id="chart_plot_02" class="demo-placeholder"></div>
        </div>
    </div>
</div>