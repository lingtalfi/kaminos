<?php


namespace Module\NullosAdmin\FormRenderer;


use Bat\StringTool;
use Core\Services\A;
use Core\Services\X;
use FormRenderer\DiyFormRenderer;
use Kamille\Services\XConfig;
use Module\NullosAdmin\ThemeHelper\ThemeHelperInterface;
use Module\UploadProfile\ProfileFinder\ProfileFinderInterface;

class NullosFormRenderer extends DiyFormRenderer
{


    public function __construct()
    {

        $theme = X::get('NullosAdmin_themeHelper');
        /**
         * @var $theme ThemeHelperInterface
         */
        $theme->useLib("autocomplete");
        $theme->useLib("bootstrap-wysiwyg");
        $theme->useLib("bootstrap-colorpicker");
        $theme->useLib("bootstrap-daterangepicker");
        $theme->useLib("dropzone");
        $theme->useLib("Switchery");
//        $theme->useLib("parsley"); // we actually don't use parsley for now


        parent::__construct();

        $this->setCssClasses([
            "control" => function ($identifier, array $control, array $errors) {
                $s = 'form-control';
                $s .= ' col-md-7 col-xs-12';


                if (array_key_exists('htmlAttributes', $control) && array_key_exists('type', $control['htmlAttributes']) &&
                    (
                        'radio' === $control['htmlAttributes']['type'] ||
                        'checkbox' === $control['htmlAttributes']['type']
                    )
                ) {
                    return "";
                }
//                $s .= ' datepicker';
                if (array_key_exists($identifier, $errors)) {
                    $s .= ' parsley-error';
                }

                return $s;
            },
            "controlWrap" => function ($identifier, array $control) {
                return 'form-group';
            },
        ]);
    }


    protected function getControlHtml(array $control, array $htmlAttributes, $identifier)
    {
        $htmlAttributes['id'] = $this->getIdByIdentifier($identifier);


        switch ($control['type']) {
            case 'autocomplete':

                $id = StringTool::getUniqueCssId($identifier);
                $htmlAttributes['id'] = $id;
                $s = '<input' . StringTool::htmlAttributes($htmlAttributes) . '>' . PHP_EOL;

                $uri = $control['js']['uri'];
                $jsCode = ' 
                $("#'. $id .'").autocomplete({
                    serviceUrl: "'. $uri .'"
                });
';
                A::addBodyEndJsCode('jquery', $jsCode);

                break;
            case 'dropzone':

                $id = StringTool::getUniqueCssId($identifier);


                $s = '<div class="x_content">
                    <div id="' . $id . '" class="dropzone"></div>
                    <br />
                    <br />
                    <br />
                    <br />
                  </div>';

                $profileId = $control['conf']['profileId'];

                $finder = X::get("UploadProfile_profileFinder");
                $uploadUri = XConfig::get("UploadProfile.uploadUri");


                $conf = [
                    'url' => "$uploadUri?file=$profileId",
                    'addRemoveLinks' => $control['conf']['showDeleteLink'],
                ];
                /**
                 * @var $finder ProfileFinderInterface
                 */
                if (false !== ($profile = $finder->getProfile($profileId))) {
                    if (array_key_exists("maxFileSize", $profile)) {
                        $conf['maxFilesize'] = $profile['maxFileSize'];
                    }
                    if (array_key_exists("acceptedFiles", $profile)) {
                        $conf['acceptedFiles'] = $profile['acceptedFiles'];
                    }
                }

                $jsCode = '
                var conf = ' . json_encode($conf) . ';
                var myDropzone = new Dropzone("div#' . $id . '", conf);
';
                A::addBodyEndJsCode('jquery', $jsCode);

                break;
            case 'colorPicker':

                $this->addHtmlClass($htmlAttributes, "form-control");
                $s = '<input' . StringTool::htmlAttributes($htmlAttributes) . '>' . PHP_EOL;
                $s = '<div class="input-group demo2">' . $s . '
                        <span class="input-group-addon"><i></i></span>
                      </div>';


                break;
            case 'datetimePicker':


                $id = StringTool::getUniqueCssId($identifier);


                $this->addHtmlClass($htmlAttributes, "form-control");
                $s = '<fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-11 form-group">
                                <input type="text" class="form-control has-feedback-left" id="' . $id . '">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              </div>
                            </div>
                          </div>
                        </fieldset>';


                $jsCode = [
                    '{elementId}' => $id,
                    'init_daterangepicker' => "init_daterangepicker_" . StringTool::getUniqueCssId(),
                    'jsConfig' => json_encode($control['js']),
                ];


                $content = file_get_contents(__DIR__ . "/assets/datetimePickerInit.tpl.js");
                $jsCode = str_replace(array_keys($jsCode), array_values($jsCode), $content);
                A::addBodyEndJsCode('jquery', $jsCode);

                break;
            case 'switch':
                if ("1" === $htmlAttributes['value']) {
                    $htmlAttributes["checked"] = "checked";
                }

                $label = $control['label'];
                $htmlAttributes['class'] = 'js-switch';

                $s = '<div>
                            <label>
                              <input ' . StringTool::htmlAttributes($htmlAttributes) . '> ' . $label . '
                            </label>
                          </div>';
                break;
            case 'htmlTextArea':

                $val = (array_key_exists("value", $control)) ? $control['value'] : "";
                $style = (array_key_exists('style', $htmlAttributes)) ? $htmlAttributes['style'] : "";
                $style = 'display: none; ' . $style;

                $htmlAttributes['style'] = $style;


                $s = '<div id="alerts"></div>
                  <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      </ul>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li>
                          <a data-edit="fontSize 5">
                            <p style="font-size:17px">Huge</p>
                          </a>
                        </li>
                        <li>
                          <a data-edit="fontSize 3">
                            <p style="font-size:14px">Normal</p>
                          </a>
                        </li>
                        <li>
                          <a data-edit="fontSize 1">
                            <p style="font-size:11px">Small</p>
                          </a>
                        </li>
                      </ul>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                      <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                      <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                      <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                      <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                        <button class="btn" type="button">Add</button>
                      </div>
                      <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                      <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                    </div>
                  </div>

                  <div id="editor-one" class="editor-wrapper"></div>

                  <textarea' . StringTool::htmlAttributes($htmlAttributes) . '>' . $val . '</textarea>';
                break;
            default:
                $s = parent::getControlHtml($control, $htmlAttributes, $identifier);
                break;
        }


        return $s;
    }

    protected function doWrapControl($sClass, $identifier, $controlHtml, $hint, $label, $error)
    {
        return '
<div' . $sClass . ' data-id="' . $identifier . '">
' . $hint . '
' . $label . '
<div class="col-md-6 col-sm-6 col-xs-12">
' . $controlHtml . '
' . $error . '
</div>
</div>';
    }

    protected function getTickableControlItemHtml($type, $id, $label, $labelLeftSide, $itemHtmlAttributes, $control, $identifier)
    {
        $s = '<div class="' . $type . '">
                            <label>
                              <input ' . StringTool::htmlAttributes($itemHtmlAttributes) . '> ' . $label . '
                            </label>
                          </div>';

        if (true === $labelLeftSide) {
            // in this implementation, we don't have the choice of the left/right position
        }
        return $s;
    }


    protected function getLabel($label, $identifier, array $control)
    {
        $sReq = '';
        if (array_key_exists('htmlAttributes', $control) && in_array("required", $control['htmlAttributes'], true)) {
            $sReq .= '<span class="required">*</span>';
        }
        return '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $this->getIdByIdentifier($identifier) . '">' . $label . ' ' . $sReq . '</label>';
    }

    public function render()
    {
//        echo '<div>';
        echo $this->formOpeningTag;
        //            echo $this->centralizedFormErrors; // we don't use centralized errors!
        echo $this->controls;
        echo $this->renderSubmitButtonBar();
        echo '</form>';
//        echo '</div>';

    }


    protected function doRenderSubmitButtonBar(array $submitButtonBar)
    {
        if (true === $submitButtonBar['enable']):
            ?>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <?php if (true === $submitButtonBar['showResetButton']): ?>
                        <button class="btn btn-primary"
                                type="reset"><?php echo $submitButtonBar['textResetButton']; ?></button>
                    <?php endif; ?>
                    <button type="submit"
                            class="btn btn-success"><?php echo $submitButtonBar['textSubmitButton']; ?></button>
                </div>
            </div>
            <?php
        endif;
    }


    protected function getFormOpeningTag(array $formHtmlAttributes)
    {
        if (false === array_key_exists('class', $formHtmlAttributes)) {
            $formHtmlAttributes['class'] = "";
        }

        $formHtmlAttributes['class'] .= "form-horizontal form-label-left";

        return '<form' . StringTool::htmlAttributes($formHtmlAttributes) . '>' . PHP_EOL;
    }


    protected function wrapAllControlErrors(array $errors)
    {
        $s = '<ul class="parsley-errors-list filled" id="parsley-id-5">';
        foreach ($errors as $error) {
            $s .= '<li class="parsley-required">' . $error . '</li>';
        }
        $s .= '</ul>' . PHP_EOL;
        return $s;
    }

    protected function wrapOneControlError($error)
    {
        return '<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">' . $error . '</li></ul>' . PHP_EOL;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    private function getIdByIdentifier($identifier)
    {
        return 'id-' . $identifier;
    }

    private function addHtmlClass(array &$htmlAttributes, $class)
    {
        if (array_key_exists('class', $htmlAttributes)) {
            $htmlAttributes['class'] .= ' ' . $class;
        } else {
            $htmlAttributes['class'] = $class;
        }
    }
}