<?php


$routes['NullosAdmin_crud'] = [\Kamille\Services\XConfig::get("NullosAdmin.uriCrud"), null, null, "Controller\NullosAdmin\CrudController:render"];
$routes['NullosAdmin_users'] = [\Kamille\Services\XConfig::get("NullosAdmin.uriUsers"), null, null, "Controller\NullosAdmin\UsersController:renderList"];


$routes["NullosAdmin_ajax"] = ["/service/NullosAdmin", null, null, "Controller\NullosAdmin\NullosAdminAjaxController:handleRequest"];
$routes["NullosAdmin_home"] = ["/", null, null, "Controller\NullosAdmin\HomePageController:render"];