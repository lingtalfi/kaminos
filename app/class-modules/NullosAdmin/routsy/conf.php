<?php



$routes['NullosAdmin_users'] = [\Kamille\Services\XConfig::get("NullosAdmin.uriUsers"), null, null, "Controller\NullosAdmin\UsersController:renderList"];


$routes["NullosAdmin_ajax"] = ["/service/NullosAdmin", null, null, "Controller\NullosAdmin\NullosAdminAjaxController:handleRequest"];