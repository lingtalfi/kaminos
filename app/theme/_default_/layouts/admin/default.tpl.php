<div class="site">
    <div class="site-sidebar"><?php $l->position('sidebar'); ?></div>
    <div class="site-main">
        <div class="site-top"><?php $l->includes("top.php"); ?></div>
        <div class="site-middle position position-maincontent">
            <?php $l->position('maincontent'); ?>
        </div>
        <div class="site-bottom"><?php $l->includes("bottom.php"); ?></div>
    </div>
</div>