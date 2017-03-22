<?php


/**
 * About this template:
 *
 *
 * - it depends of Bat (uni import Bat).
 * - it uses fieldset for grouping controls
 *
 *
 *
 *
 */
use Bat\StringTool;
use KamilleWidgets\FormWidget\Kris\TemplateHelper\TemplateHelperInterface;


$formErrorPosition = "control";
$displayFirstErrorOnly = false;
if (array_key_exists('form', $v)) {
    if (array_key_exists('formErrorPosition', $v['form'])) {
        $formErrorPosition = $v['form']['formErrorPosition'];
    }
    if (array_key_exists('displayFirstErrorOnly', $v['form'])) {
        $displayFirstErrorOnly = $v['form']['displayFirstErrorOnly'];
    }
}


/**
 * @var TemplateHelperInterface $templateHelper
 */
$templateHelper = $v['templateHelper'];
$templateHelper->setDisplayFirstErrorOnly($displayFirstErrorOnly);
$templateHelper->setFormErrorPosition($formErrorPosition);



//--------------------------------------------
// CONFIGURE FORM TOP
//--------------------------------------------
$formOpeningTag = '';
$formHtmlAttributes = [];
if (array_key_exists('form', $v)) {
    $form = $v['form'];
    if (array_key_exists('htmlAttributes', $form)) {
        $formHtmlAttributes = $form['htmlAttributes'];
    }
}

$formOpeningTag = '<form' . StringTool::htmlAttributes($formHtmlAttributes) . '>' . PHP_EOL;


//--------------------------------------------
// COLLECTING ERRORS
//--------------------------------------------
$errors = [];
foreach ($v['controls'] as $identifier => $control) {
    if (array_key_exists('errors', $control) && count($control['errors']) > 0) {
        $errors[$identifier] = $control['errors'];
    }
}


//--------------------------------------------
// CAPTURING THE CONTROLS
//--------------------------------------------
$controls = [];
foreach ($v['controls'] as $identifier => $control):
    $htmlAttributes = (array_key_exists("htmlAttributes", $control)) ? $control['htmlAttributes'] : [];
    $sControl = "";
    switch ($control['type']) {
        case 'input':
            $htmlType = "text";
            if (array_key_exists("type", $htmlAttributes)) {
                $htmlType = $htmlAttributes["type"];
            }
            if ('text' === $htmlType || "submit" === $htmlType || 'file' === $htmlType) {
                $sControl = '<input' . StringTool::htmlAttributes($htmlAttributes) . '>' . PHP_EOL;
            } elseif (
                'checkbox' === $htmlType ||
                'radio' === $htmlType
            ) {

                $isRadio = ('radio' === $htmlType);

                if (false === $isRadio) {
                    $keyWord = "checked";
                    $values = (array_key_exists("value", $control)) ? $control['value'] : [];
                } elseif (true === $isRadio) {
                    $keyWord = "checked";
                    $values = (array_key_exists("value", $control)) ? $control['value'] : null;
                }


                $cpt = 0;
                $items = (array_key_exists("items", $control)) ? $control['items'] : [];
                $labelLeftSide = (array_key_exists("labelLeftSide", $control)) ? $control['labelLeftSide'] : true;
                foreach ($items as $value => $label) {

                    $itemHtmlAttributes = $htmlAttributes;

                    $id = $value . "-" . $cpt++;
                    $itemHtmlAttributes["value"] = htmlspecialchars($value);
                    $itemHtmlAttributes["id"] = $id;


                    if (
                        (false === $isRadio && in_array($value, $values, true)) ||
                        (true === $isRadio && $value === $values)
                    ) {
                        $itemHtmlAttributes[$keyWord] = $keyWord;
                    }


                    $sInput = '<input ' . StringTool::htmlAttributes($itemHtmlAttributes) . '>' . PHP_EOL;
                    $sLabel = '<label for="' . $id . '">' . $label . '</label>' . PHP_EOL;
                    if (true === $labelLeftSide) {
                        $sControl .= $sLabel . $sInput;
                    } else {
                        $sControl .= $sInput . $sLabel;
                    }
                }

            } else {
                $sControl = "Unknown control type: " . $control['type'] . '(' . $htmlType . ')';
            }
            break;
        case 'select':
            $sControl = '<select' . StringTool::htmlAttributes($htmlAttributes) . '>' . PHP_EOL;
            $items = (array_key_exists("items", $control)) ? $control['items'] : [];


            $isMultiple = (in_array("multiple", $htmlAttributes, true));

            if (false === $isMultiple) {
                $val = (array_key_exists("value", $control)) ? $control['value'] : "";
                foreach ($items as $value => $label) {
                    $s = ($val === $value) ? ' selected="selected"' : "";
                    $sControl .= '<option' . $s . ' value="' . htmlspecialchars($value) . '">' . $label . '</option>' . PHP_EOL;
                }
            } else {
                $values = (array_key_exists("value", $control)) ? $control['value'] : [];
                foreach ($items as $value => $label) {
                    $s = (in_array($value, $values, true)) ? ' selected="selected"' : "";
                    $sControl .= '<option' . $s . ' value="' . htmlspecialchars($value) . '">' . $label . '</option>' . PHP_EOL;
                }
            }

            $sControl .= '</select>' . PHP_EOL;
            break;
        case 'textarea':
            $sControl = '<textarea' . StringTool::htmlAttributes($htmlAttributes) . '>';
            $val = (array_key_exists("value", $control)) ? $control['value'] : "";
            $sControl .= $val;
            $sControl .= '</textarea>' . PHP_EOL;
            break;
        default:
            $sControl = "Unknown control type: " . $control['type'];
            break;
    }
    $controls[$identifier] = $templateHelper->wrapControl($sControl, $control, $identifier);
endforeach;


//--------------------------------------------
// CAPTURING THE GROUPS
//--------------------------------------------
$allGroups = [];
$groups = [];
if (array_key_exists('groups', $v) && is_array($v['groups'])) {
    $groups = $v['groups'];
}

foreach ($groups as $groupIdentifier => $groupInfo) {
    $allGroups[$groupIdentifier] = $templateHelper->wrapGroup($groupIdentifier, $groupInfo, $controls, $groups, $allGroups);
}


//--------------------------------------------
// CREATING THE ERRORS AT A CENTRALIZED PLACE
//--------------------------------------------
$sFormErrors = "";

if ('central' === $formErrorPosition && count($errors) > 0) {
    if (true === $displayFirstErrorOnly) {
        reset($errors);
        $identifier = key($errors);
        $errorMsg = current(current($errors));
        $error = $templateHelper->formatCentralizedError($identifier, $errorMsg, $v['controls']);
        $sFormErrors = $templateHelper->wrapOneFormError($error);
    } else {
        $tmpErrors = [];
        foreach ($errors as $identifier => $error) {
            foreach ($error as $err) {
                $tmpErrors[] = $templateHelper->formatCentralizedError($identifier, $err, $v['controls']);
            }
        }
        $sFormErrors = $templateHelper->wrapAllFormErrors($tmpErrors);
    }
}


//--------------------------------------------
// COLLECTING ALL CONTROLS IN ORDER
//--------------------------------------------
$allControls = [];
$sAllControls = "";
if (array_key_exists('order', $v) && is_array($v['order'])) {
    $allControls = $v['order'];
} else {
    $allControls = array_keys($controls);
}
foreach ($allControls as $identifier) {
    if (array_key_exists($identifier, $allGroups)) {
        $sAllControls .= $allGroups[$identifier];
    } elseif (array_key_exists($identifier, $controls)) {
        $sAllControls .= $controls[$identifier];
    } else {
        $sAllControls .= $templateHelper->onControlNotFound($identifier);
    }
}


//--------------------------------------------
// COLLECTING FORM MESSAGES
//--------------------------------------------
$sFormMessages = '';
if (array_key_exists('form', $v) && array_key_exists('messages', $v['form'])) {
    $sFormMessages = $templateHelper->wrapFormMessages($v['form']['messages']);
}

//--------------------------------------------
// DISPLAYING THE WHOLE FORM
//--------------------------------------------
echo $formOpeningTag;
echo $sFormMessages;
echo $sFormErrors;
echo $sAllControls;
echo '</form>';