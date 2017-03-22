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

define("FORM_ERROR_POSITION", $formErrorPosition);
define("DISPLAY_FIRST_ERROR_ONLY", $displayFirstErrorOnly);


//--------------------------------------------
// FUNCTION DECLARATION - WRAPPING CONTROLS
//--------------------------------------------
/**
 * If you change the template, perhaps the only thing you need to change is this wrapControl
 * function, and its children wrapHint and wrapErrors function.
 */
function wrapControl($s, array $control, $identifier)
{


    $hint = array_key_exists('hint', $control) ? $control['hint'] : null;
    $label = array_key_exists('label', $control) ? $control['label'] : null;
    $errors = array_key_exists('errors', $control) ? $control['errors'] : [];


    $sError = "";

    if (null !== $hint) {
        $hint = wrapHint($hint);
    }


    if ('control' === FORM_ERROR_POSITION && count($errors) > 0) {
        if (false === DISPLAY_FIRST_ERROR_ONLY) {
            $sError = wrapAllControlErrors($errors);
        } else {
            $error = array_shift($errors);
            $sError = wrapOneControlError($error);
        }
    }


    if (null !== $label) {
        $label = '<label>' . $label . '</label>';
    }

    $ret = '
<div class="type-' . $control['type'] . ' id-' . $identifier . '" data-id="' . $identifier . '">
' . $hint . '
' . $label . '
' . $s . '
' . $sError . '
</div>';
    return $ret;
}

function wrapHint($hint)
{
    return '<div class="hint">' . $hint . '</div>' . PHP_EOL;
}

function wrapAllControlErrors(array $errors)
{
    $s = '';
    $s .= '<ul class="errors">' . PHP_EOL;
    foreach ($errors as $error) {
        $s .= '<li class="error">' . $error . '</li>' . PHP_EOL;
    }
    $s .= '</ul>' . PHP_EOL;
    return $s;
}

function wrapOneControlError($error)
{
    return '<div class="error">' . $error . '</div>' . PHP_EOL;
}

function wrapAllFormErrors(array $errors)
{
    return wrapAllControlErrors($errors);
}

function wrapOneFormError($errorMsg)
{
    return wrapOneControlError($errorMsg);
}


function onControlNotFound($identifier)
{
    return "Control not found: $identifier";
}

function wrapGroup($groupIdentifier, array $groupInfo, array $controls, array $groups, array &$allGroups)
{

    $children = [];
    if (array_key_exists("children", $groupInfo) && null !== $groupInfo['children']) {
        $children = $groupInfo['children'];
    }
    $sLegend = "";
    if (array_key_exists("label", $groupInfo) && null !== $groupInfo['label']) {
        $sLegend = '<legend>' . htmlspecialchars($groupInfo['label']) . '</legend>' . PHP_EOL;
    }

    $s = '<fieldset>' . PHP_EOL;
    $s .= $sLegend;
    foreach ($children as $childIdentifier) {
        if (array_key_exists($childIdentifier, $controls)) {
            $s .= $controls[$childIdentifier];
        } elseif (array_key_exists($childIdentifier, $allGroups)) {
            $s .= $allGroups[$childIdentifier];
        } elseif (array_key_exists($childIdentifier, $groups)) {
            $s .= wrapGroup($childIdentifier, $groups[$childIdentifier], $controls, $groups, $allGroups);
        } else {
            $s .= onControlNotFound($groupIdentifier);
        }
    }
    $s .= '</fieldset>' . PHP_EOL;
    return $s;
}


function wrapFormMessages(array $formMessages)
{
    $s = '';
    if (count($formMessages) > 0) {
        $s .= '<ul class="form-messages">' . PHP_EOL;
        foreach ($formMessages as $msgInfo) {
            list($msg, $type) = $msgInfo;
            $s .= '<li class="form-message form-message-' . $type . '">' . $msg . '</li>' . PHP_EOL;
        }
        $s .= '</ul>' . PHP_EOL;
    }
    return $s;
}


function formatCentralizedError($identifier, $errorMsg, array $controls)
{
    $name = $identifier;
    if (
        array_key_exists($identifier, $controls) &&
        array_key_exists("label", $controls[$identifier])
    ) {
        $name = $controls[$identifier]["label"];
    }
    return "$name: " . $errorMsg;
}

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
    $controls[$identifier] = wrapControl($sControl, $control, $identifier);
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
    $allGroups[$groupIdentifier] = wrapGroup($groupIdentifier, $groupInfo, $controls, $groups, $allGroups);
}


//--------------------------------------------
// CREATING THE ERRORS AT A CENTRALIZED PLACE
//--------------------------------------------
$sFormErrors = "";

if ('central' === $formErrorPosition && count($errors) > 0) {
    if (true === DISPLAY_FIRST_ERROR_ONLY) {
        reset($errors);
        $identifier = key($errors);
        $errorMsg = current(current($errors));
        $error = formatCentralizedError($identifier, $errorMsg, $v['controls']);
        $sFormErrors = wrapOneFormError($error);
    } else {
        $tmpErrors = [];
        foreach ($errors as $identifier => $error) {
            foreach ($error as $err) {
                $tmpErrors[] = formatCentralizedError($identifier, $err, $v['controls']);
            }
        }
        $sFormErrors = wrapAllFormErrors($tmpErrors);
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
        $sAllControls .= onControlNotFound($identifier);
    }
}


//--------------------------------------------
// COLLECTING FORM MESSAGES
//--------------------------------------------
$sFormMessages = '';
if (array_key_exists('form', $v) && array_key_exists('messages', $v['form'])) {
    $sFormMessages = wrapFormMessages($v['form']['messages']);
}

//--------------------------------------------
// DISPLAYING THE WHOLE FORM
//--------------------------------------------
echo $formOpeningTag;
echo $sFormMessages;
echo $sFormErrors;
echo $sAllControls;
echo '</form>';