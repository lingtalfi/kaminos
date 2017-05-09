<?php





$routes["DataTable_crudHandler"] = ["/crud-handler", null, null, '\Controller\DataTable\CrudController:handleCrud'];

$routes['DataTable_ajaxActionsHandler'] = [\Kamille\Services\XConfig::get("DataTable.uriAjaxActionsHandler"), null, [
    'inGet' => ["type"],
], "DataTable\AppDataTableController:handleAjaxAction"]; // this controller needs to be implemented by the user
$routes['DataTable_ajaxHandler'] = [\Kamille\Services\XConfig::get("DataTable.uriAjaxHandler"), null, null, "Controller\DataTable\DataTableController:handleAjax"];



