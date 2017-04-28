<div class="x_panel">
    <div class="x_title">
        <h2>Form Design
            <small>different form elements</small>
        </h2>
        <?php use Module\NullosAdmin\FormRenderer\NullosFormRenderer;

        $l->includes('xPaneRightToolBar.php'); ?>
    </div>
    <div class="x_content">
        <br/>
        <?php NullosFormRenderer::create()->prepare($v['formModel'])->render(); ?>
    </div>
</div>