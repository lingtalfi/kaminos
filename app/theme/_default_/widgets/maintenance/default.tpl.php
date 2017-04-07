<div class="widget widget-maintenance">
    <?php if (null !== $v['logo_src']): ?>
        <img class="logo image" width="100" src="<?php echo htmlspecialchars($v['logo_src']); ?>"
             alt="<?php echo htmlspecialchars($v['logo_alt']); ?>"/>
    <?php endif; ?>

    <div class="main-text"><?php echo $v['main_text']; ?></div>

    <?php if (null !== $v['aux_text']): ?>
        <div class="aux-text"><?php echo $v['aux_text']; ?></div>
    <?php endif; ?>

    <?php if (null !== $v['image_src']): ?>
        <img class="image" width="300"
             src="<?php echo htmlspecialchars($v['image_src']); ?>"
             alt="<?php echo htmlspecialchars($v['image_alt']); ?>"/>
    <?php endif; ?>

</div>
