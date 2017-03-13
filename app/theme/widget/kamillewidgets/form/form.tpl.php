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

$formErrorPosition = $v['formErrorPosition'];
$displayFirstErrorOnly = $v['displayFirstErrorOnly'];


//--------------------------------------------
// FUNCTION DECLARATION - WRAPPING CONTROLS
//--------------------------------------------
/**
 * If you change the template, perhaps the only thing you need to change is this wrapControl
 * function, and its children wrapHint and wrapErrors function.
 */
function wrapControl($s, array $control, $identifier)
{

    global $formErrorPosition, $displayFirstErrorOnly;


    $hint = $control['hint'];
    $errors = $control['errors'];
    $sError = "";

    if (null !== $hint) {
        $hint = wrapHint($hint);
    }


    if ('control' === $formErrorPosition && count($errors) > 0) {
        if (false === $displayFirstErrorOnly) {
            $sError = wrapAllControlErrors($errors);
        } else {
            $error = array_shift($errors);
            $sError = wrapOneControlError($error);
        }
    }
    $ret = '
<div class="type-' . $control['type'] . ' id-' . $identifier . '" data-id="' . $identifier . '">
' . $hint . '
' . $s . '
' . $sError . '
</div>';
    return $ret;
}

function wrapHint($hint)
{
    return '<div class="hint">' . $hint . '</div>';
}

function wrapAllControlErrors(array $errors)
{
    $s = '';
    $s .= '<ul class="errors">';
    foreach ($errors as $error) {
        $s .= '<li class="error">' . $error . '</li>';
    }
    $s .= '</ul>';
    return $s;
}

function wrapOneControlError($error)
{
    return '<div class="error">' . $error . '</div>';
}

function wrapAllFormErrors(array $errors)
{
    return wrapAllControlErrors($errors);
}

function wrapOneFormError($error)
{
    return wrapOneControlError($error);
}


function di(array $elements){

}


//--------------------------------------------
// DISPLAY FORM TOP
//--------------------------------------------
$formOpeningTag = '';
$formHtmlAttributes = [];
if (array_key_exists('form', $v)) {
    $form = $v['form'];
    if (array_key_exists('htmlAttributes', $form)) {
        $formHtmlAttributes = $form['htmlAttributes'];
    }
}

$formOpeningTag = '<form' . StringTool::htmlAttributes($formHtmlAttributes) . '>';


//--------------------------------------------
// COLLECTING ERRORS
//--------------------------------------------
$errors = [];
foreach ($v['controls'] as $identifier => $control) {
    if (count($control['errors']) > 0) {
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
            $sControl = '<input' . StringTool::htmlAttributes($htmlAttributes) . '>';
            break;
        default:
            $sControl = "Unknown control type: " . $control['type'];
            break;
    }
    $controls[$identifier] = wrapControl($sControl, $control, $identifier);
endforeach;


//--------------------------------------------
// DISPLAYING THE ERRORS AT A CENTRALIZED PLACE
//--------------------------------------------
$sFormErrors = "";
if ('central' === $formErrorPosition && count($errors) > 0) {
    if (false === $displayFirstErrorOnly) {
        $error = array_shift($errors);
        $sFormErrors = wrapOneFormError($error);
    } else {
        $sFormErrors = wrapAllFormErrors($errors);
    }
}


//--------------------------------------------
// DISPLAYING THE CONTROLS
//--------------------------------------------
foreach ($controls as $identifier => $sControl) {
    echo $sControl;
}


echo '</form>';