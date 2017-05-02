<?php


$routes['DataTable_ajaxActionsHandler'] = [\Kamille\Services\XConfig::get("DataTable.uriAjaxHandler"), null, [
    'inGet' => ["type"],
], "DataTable\AppDataTableController:handleAjaxAction"]; // this controller needs to be implemented
$routes['DataTable_ajaxHandler'] = [\Kamille\Services\XConfig::get("DataTable.uriAjaxHandler"), null, null, "Controller\DataTable\DataTableController:handleAjax"];

