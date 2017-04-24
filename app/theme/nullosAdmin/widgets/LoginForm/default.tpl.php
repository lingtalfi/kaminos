<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;


$prefixUri = "/theme/" . ApplicationParameters::get("theme");



HtmlPageHelper::$title = "Gentelella Alela! | ";
HtmlPageHelper::css("$prefixUri/vendors/animate.css/animate.min.css"); // animage.css


HtmlPageHelper::addBodyClass("login");
?>


<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="post" action="">


                    <h1>{title}</h1>
                    <?php
                    use FormRenderer\DiyFormRenderer;


                    $submitName = $v['formModel']['controls']['submit']['htmlAttributes']['name'];

                    $fr = DiyFormRenderer::create()
                        ->setQuietControls(["submit"])
                        ->setCssClass("control", function ($identifier, array $control) {
                            if ('submit' === $identifier) {
                                return "btn btn-default submit";
                            }
                            return "form-control";
                        })
                        ->prepare($v['formModel']);

                    echo $fr->render();

                    ?>

                    <div>
                        <button name="<?php echo $submitName; ?>" type="submit" class="btn btn-default submit">
                            {textSubmit}
                        </button>
                        <?php if (true === $v['showForgotPasswordLink']): ?>
                            <a class="reset_pass" href="{uriForgotPassword}">{textForgotPassword}</a>
                        <?php endif; ?>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <?php if (true === $v['showCreateAccountLink']): ?>
                            <p class="change_link">{textNewToSite}
                                <a href="{uriCreateAccount}#signup" class="to_register"> {textCreateAccount} </a>
                            </p>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and
                                Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input:first').focus();
    });
</script>