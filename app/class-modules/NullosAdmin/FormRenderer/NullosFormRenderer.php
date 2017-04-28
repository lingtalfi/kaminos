<?php


namespace Module\NullosAdmin\FormRenderer;


use FormRenderer\DiyFormRenderer;

class NullosFormRenderer extends DiyFormRenderer
{


    public function __construct()
    {
        parent::__construct();
        $this->setCssClasses([
            "control" => function ($identifier, array $control) {
                $s = 'form-control';
                $s .= ' col-md-7 col-xs-12';

                if (true === "type=radio|checkbox") {
                    return "";
                }
//                $s .= ' datepicker';

                return $s;
            },
            "controlWrap" => function ($identifier, array $control) {
                return 'form-group';
            },
        ]);
    }

    protected function getControlHtml(array $control, array $htmlAttributes)
    {
        $s = parent::getControlHtml($control, $htmlAttributes);
        return '<div class="col-md-6 col-sm-6 col-xs-12">' . $s . '</div>';
    }


    protected function getLabel($label, $identifier, array $control)
    {
        $sReq = '';
        if (array_key_exists('htmlAttributes', $control) && in_array("required", $control['htmlAttributes'], true)) {
            $sReq .= '<span class="required">*</span>';
        }
        return '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id-' . $identifier . '">' . $label . ' ' . $sReq . '</label>';
    }

    public function render()
    {
        echo $this->formOpeningTag;
        //            echo $this->centralizedFormErrors; // we don't use centralized errors!
        echo $this->controls;
        echo '</form>';

        // call prepare first...
        ?>
        <!--        <div class="form-group">-->
        <!--            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span-->
        <!--                        class="required">*</span>-->
        <!--            </label>-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span-->
        <!--                        class="required">*</span>-->
        <!--            </label>-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                <input type="text" id="last-name" name="last-name" required="required"-->
        <!--                       class="form-control col-md-7 col-xs-12">-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                <div id="gender" class="btn-group" data-toggle="buttons">-->
        <!--                    <label class="btn btn-default" data-toggle-class="btn-primary"-->
        <!--                           data-toggle-passive-class="btn-default">-->
        <!--                        <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;-->
        <!--                    </label>-->
        <!--                    <label class="btn btn-primary" data-toggle-class="btn-primary"-->
        <!--                           data-toggle-passive-class="btn-default">-->
        <!--                        <input type="radio" name="gender" value="female"> Female-->
        <!--                    </label>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="form-group">-->
        <!--            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>-->
        <!--            </label>-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required"-->
        <!--                       type="text">-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="ln_solid"></div>-->
        <!--        <div class="form-group">-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
        <!--                <button class="btn btn-primary" type="button">Cancel</button>-->
        <!--                <button class="btn btn-primary" type="reset">Reset</button>-->
        <!--                <button type="submit" class="btn btn-success">Submit</button>-->
        <!--            </div>-->
        <!--        </div>-->

        <?php
    }
}