<?php


use Core\Services\A;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XConfig;




$url = "/modules/DataTable/datatable.js";

HtmlPageHelper::js($url, "datatable", [], false);



$uri = XConfig::get("DataTable.uriAjaxHandler");



A::addBodyEndJsCode('jquery', '
function initDataTable() {
    console.log("init datatable");
    $(\'.datatable_view\').dataTable({
        uri: ' . json_encode($uri) . '
    });
}

initDataTable();

');

?>
<div class="datatable_view" data-id="{profileId}"></div>