<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <?php foreach ($v['buttons'] as $b):
        $sLink = "";
        if (array_key_exists('link', $b)) {
            $sLink = ' href="' . $b['link'] . '"';
        }
        ?>
        <a data-toggle="tooltip" data-placement="top"
           title="<?php echo htmlspecialchars($b['title']); ?>" <?php echo $sLink; ?>>
            <span class="<?php echo $b['icon']; ?>" aria-hidden="true"></span>
        </a>
    <?php endforeach; ?>
</div>
<!-- /menu footer buttons -->

