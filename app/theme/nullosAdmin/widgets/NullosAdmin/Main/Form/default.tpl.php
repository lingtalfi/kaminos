<?php
use Module\NullosAdmin\FormRenderer\NullosFormRenderer;


?>
<?php if (true === $v['wrap']): ?>
<div class="x_panel">
    <div class="x_title">
        <h2>Form Design
            <small>different form elements</small>
        </h2>
        <?php
        $l->includes('panelToolbox.php'); ?>
    </div>
    <div class="x_content">
        <br/>
        <?php endif; ?>


        <?php
        $renderer = NullosFormRenderer::create()->prepare($v['formModel']);
        if (false === $v['showSubmitButtonsGroup']) {
            $renderer->setShowSubmitButtonsGroup(false);
        }
        $renderer->render();
        ?>


        <?php if (true === $v['wrap']): ?>
    </div>
</div>
<?php endif; ?>
