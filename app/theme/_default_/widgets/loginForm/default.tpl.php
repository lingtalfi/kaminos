<div class="widget widget-loginform">

    <?php if (null !== $v['title']): ?>
        <h1>{title}</h1>
    <?php endif; ?>

    <?php
    use FormRenderer\FormRenderer;

    echo FormRenderer::create()->prepare($v['formModel'])->render();
    ?>


    <?php if (true === $v['showForgotPasswordLink']): ?>
        <div>
            <a href="{uriForgotPassword}">{textForgotPassword}</a>
        </div>
    <?php endif; ?>

    <?php if (true === $v['showCreateAccountLink']): ?>
        <div>
            New to site? <a href="{uriCreateAccount}">{textCreateAccount}</a>
        </div>
    <?php endif; ?>
</div>
