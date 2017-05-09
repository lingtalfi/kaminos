<?php
use Module\NullosAdmin\FormRenderer\NullosFormRenderer;


?>
<?php if (true === $v['wrap']): ?>
<div class="x_panel">
    <div class="x_title">
        <h2>{title}
            <?php if (array_key_exists('subtitle', $v) && null !== $v['subtitle']): ?>
                <small>{subtitle}</small>
            <?php endif; ?>
        </h2>
        <?php
        $l->includes('panelToolbox.php'); ?>
    </div>
    <div class="x_content">
        <br/>
        <?php endif; ?>


        <?php
        $renderer = NullosFormRenderer::create()->prepare($v['formModel']);
        $renderer->render();
        ?>
        <?php if (true === $v['wrap']): ?>
    </div>
</div>
<?php endif; ?>

<?php
/**
 * Applying the logic below only if the form is called via ajax.
 *
 * Basically intercepting the submit call and posting the form via ajax
 * if this is the case (rather than traditional posting).
 */
if (array_key_exists("isAjax", $v) && true === $v['isAjax']): ?>
    <script>
        /**
         * In this case, jquery has already been loaded by the nullos theme.
         */
//        var jForm = $("form[data-ajax=1]");
        var jForm = $("#ajax-modal-main form:first");
        jForm
            .off('submit.nullos')
            .on('submit.nullos', function () {
                var uri = "crud?type=ajaxFormPost&prc=NullosAdmin.User";
                $.fn.nullos.postForm(jForm, uri, "{onAjaxPostMode}");
                return false;
            });


    </script>
<?php endif; ?>
