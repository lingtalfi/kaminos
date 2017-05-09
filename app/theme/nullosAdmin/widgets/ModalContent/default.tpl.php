<?php
use Bat\StringTool;
use Module\NullosAdmin\ThemeHelper\ThemeHelper;

$type = ThemeHelper::inst()->getBsType($v['type']);

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
    </button>
    <?php if (null !== $v['title']): ?>
        <h4 class="modal-title text-<?php echo $type; ?>" id="myModalLabel">{title}</h4>
    <?php endif; ?>
</div>
<div class="modal-body">{message}</div>
<div class="modal-footer">
    <?php if (array_key_exists('buttons', $v)): ?>
        <?php foreach ($v['buttons'] as $button): ?>

            <!--    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <button type="button"
                    class="btn btn-<?php echo $button['flavour']; ?>" <?php echo StringTool::htmlAttributes($button['htmlAttr']); ?>><?php echo $button['label']; ?></button>

        <?php endforeach ?>
    <?php endif; ?>
</div>