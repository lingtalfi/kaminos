<?php

use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;


$prefixUri = "/theme/" . ApplicationParameters::get("theme");

HtmlPageHelper::setLang("en");
HtmlPageHelper::addMetaBlock('
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
');


HtmlPageHelper::css("$prefixUri/vendors/bootstrap/dist/css/bootstrap.min.css"); // bootstrap
HtmlPageHelper::css("$prefixUri/vendors/font-awesome/css/font-awesome.min.css"); // font awesome
HtmlPageHelper::css("$prefixUri/vendors/nprogress/nprogress.css"); // nprogress
HtmlPageHelper::css("$prefixUri/build/css/custom.min.css"); // custom theme style


// bottom scripts
HtmlPageHelper::js("$prefixUri/vendors/jquery/dist/jquery.min.js", "jquery", null, false);
HtmlPageHelper::js("$prefixUri/vendors/bootstrap/dist/js/bootstrap.min.js", null, null, false);
HtmlPageHelper::js("$prefixUri/vendors/fastclick/lib/fastclick.js", null, null, false);
HtmlPageHelper::js("$prefixUri/vendors/nprogress/nprogress.js", null, null, false);


HtmlPageHelper::js("$prefixUri/nullos.js", null, null, false);


HtmlPageHelper::js("$prefixUri/build/js/custom.js", null, null, 'after');
//HtmlPageHelper::js("$prefixUri/build/js/custom.min.js", null, null, 'after');


if (array_key_exists('jsScripts', $v)) {
    foreach ($v['jsScripts'] as $uri) {
        HtmlPageHelper::js($uri, null, null, false);
    }
}
