<div class="widget widget-notification">

    <?php
    foreach ($v['notifications'] as $notif): ?>
        <div class="notification notification-<?php echo $notif['type']; ?>">
            <?php if (null !== $notif['title']): ?>
                <span class="title"><?php echo $notif['title']; ?></span>
            <?php endif; ?>
            <p class="message"><?php echo $notif['msg']; ?></p>
        </div>
    <?php endforeach; ?>
</div>
