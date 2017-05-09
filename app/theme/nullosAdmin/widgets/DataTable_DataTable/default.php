<?php


use Core\Services\A;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XConfig;


$url = "/modules/DataTable/datatable.js";

HtmlPageHelper::js($url, "datatable", [], false);
$uri = XConfig::get("DataTable.uriAjaxHandler");


$renderer = 'Module\NullosAdmin\ModelRenderers\DataTable\NullosDataTableRenderer';


A::addBodyEndJsCode('jquery', '
function initDataTable() {
    console.log("init datatable");
    $(\'.datatable_view\').dataTable({
        uri: ' . json_encode($uri) . ',
        renderer: "' . str_replace('\\', '\\\\', $renderer) . '"
    });
}

initDataTable();

');

?>
<div class="datatable_view" data-id="{profileId}"></div>