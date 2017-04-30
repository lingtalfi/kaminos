<?php
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;

$l->includes("common.php");
HtmlPageHelper::addBodyClass("nav-md");
?>

<div class="container body">
    <div class="main_container">
        <?php $l->position('main'); ?>
    </div>
</div>
