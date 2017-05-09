<?php

use Module\NullosAdmin\ThemeHelper\ThemeHelper;

?>
<?php if (count($v['notifications']) > 0): ?>
    <div class="x_panel">
        <div class="x_content bs-example-popovers">
            <?php foreach ($v['notifications'] as $notif):
                $type = ThemeHelper::getBsType($notif['type']);
                ?>
                <div class="alert alert-<?php echo $type; ?> alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                    </button>
                    <?php if (null !== $notif['title']): ?>
                        <strong><?php echo $notif['title']; ?></strong>
                    <?php endif; ?>
                    <?php echo $notif['msg']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>