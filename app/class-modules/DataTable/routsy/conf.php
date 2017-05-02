<?php


use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;

$routes['DataTable_ajaxActionsHandler'] = [\Kamille\Services\XConfig::get("DataTable.uriAjaxActionsHandler"), null, [
    'inGet' => ["type"],
], "DataTable\AppDataTableController:handleAjaxAction"]; // this controller needs to be implemented by the user
$routes['DataTable_ajaxHandler'] = [\Kamille\Services\XConfig::get("DataTable.uriAjaxHandler"), null, null, "Controller\DataTable\DataTableController:handleAjax"];



