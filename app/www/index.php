<?php


use Core\Services\X;
use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Request\Web\HttpRequest;
use Kamille\Services\XInstalledModules;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";


$app = WebApplication::inst();
X::get("Core_webApplicationHandler")->handle($app);


