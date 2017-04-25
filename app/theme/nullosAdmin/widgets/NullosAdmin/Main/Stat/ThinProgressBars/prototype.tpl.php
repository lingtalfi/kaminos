<?php

use Core\Services\X;
use Module\NullosAdmin\ThemeHelper\ThemeHelperInterface;

$theme = X::get('NullosAdmin_themeHelper');
/**
 * @var $theme ThemeHelperInterface
 */
$theme->useLib("bootstrap-progressbar");


?>

<div class="x_title">
    <h2>Top Campaign Performance</h2>
    <div class="clearfix"></div>
</div>

<div class="col-md-12 col-sm-12 col-xs-6">
    <div>
        <p>Facebook Campaign</p>
        <div class="">
            <div class="progress progress_sm" style="width: 76%;">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
            </div>
        </div>
    </div>
    <div>
        <p>Twitter Campaign</p>
        <div class="">
            <div class="progress progress_sm" style="width: 76%;">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-6">
    <div>
        <p>Conventional Media</p>
        <div class="">
            <div class="progress progress_sm" style="width: 76%;">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
            </div>
        </div>
    </div>
    <div>
        <p>Bill boards</p>
        <div class="">
            <div class="progress progress_sm" style="width: 76%;">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
            </div>
        </div>
    </div>
</div>
