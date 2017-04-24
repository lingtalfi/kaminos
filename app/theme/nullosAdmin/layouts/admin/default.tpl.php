<?php

use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;


$l->includes("common.php");


$prefixUri = "/theme/" . ApplicationParameters::get("theme");
$imgPrefix = $prefixUri . "/production";


HtmlPageHelper::css("$prefixUri/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css");


HtmlPageHelper::addBodyClass("nav-md");
?>
<div class="container body">
    <div class="main_container">

        <?php $l->includes('sidebar.php'); ?>
        <?php $l->includes('top.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <?php $l->position('maincontent'); ?>
        </div>
        <!-- /page content -->

        <?php $l->includes('bottom.php'); ?>
    </div>
</div>

