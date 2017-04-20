<?php

use Authenticate\SessionUser\SessionUser;
use Authenticate\UserStore\UserStoreInterface;
use BabyYaml\BabyYamlUtil;
use Kamille\Utils\Routsy\Util\ConfigGenerator\ConfigGenerator;
use LinearFile\LineSetFinder\BiggestWrapLineSetFinder;


require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";




//$f = "/myphp/kaminos/app/config/routsy/routes.php";
//
//$lines = file($f);
//$pat = '!^\$routes\[([^\]]+)\]\s*=!';
//a(BiggestWrapLineSetFinder::create()
//    ->setPrepareNameCallback(function ($v) {
//        return substr($v, 1, -1);
//    })
//    ->setNamePattern($pat)
//    ->setStartPattern($pat)
//    ->setPotentialEndPattern('!\];!')
//    ->find($lines)
//);
//az();

$f = "/myphp/kaminos/app/config/routsy/routes.php";
$modulesDir = "/myphp/kaminos/app/class-modules";
a(ConfigGenerator::create()
    ->setConfFile($f)
    ->setModulesTargetDir($modulesDir)
    ->generate());


//$routes = [];
//include "/myphp/kaminos/app/config/routsy/routes.php";
//
//$router = RoutsyRouter::create()->setRoutes($routes);
//
//
//$_GET['disconnect'] = "pou";
//$_GET['ee'] = "45";
//$_GET['pou'] = "pl";
//$_POST['disconnect'] = "pou";
//$_POST['ee'] = "45";
//$_POST['pou'] = "pl";
//
//a($router->match(WritableHttpRequest::create()->setUri("/pou")));
//a($router->match(WritableHttpRequest::create()->setUri("/pou2")));
//a($router->match(WritableHttpRequest::create()->setUri("/po/49/some")));
//a($router->match(WritableHttpRequest::create()
//    ->setIsHttps(true)
//    ->setUri("/my/64/uri")
//));
//
//
//
//a(LinkGenerator::create()->setRoutes($routes)->getUri("Core_myRouteId5", [
//    'dynamic' => 46,
//]));


az();
//
//
//
//$f = "/myphp/kaminos/app/class-core/Services/Hooks.php";
//a(ClassCooker::create()->setFile($f)->getMethodSignature("Core_feedUri2Controller"));
//
//
//
//
//
//az();
/**
 * @var $userStore UserStoreInterface
 */
$userStore = X::get("Authenticate_userStore");

if (false !== ($user = $userStore->getUserByCredentials("me", "me"))) {

    $props = UserToSessionConvertor::toSession($user);
    SessionUser::connect($props);

    a(A::has("badgef2"));

} else {
    a("boo");
}


az();


//a($_POST);
// <meta charset="utf-8" />
HtmlPageHelper::addMeta(["charset" => "utf-8"]);


$viewId = "tuc";
$useCssAutoload = true;
echo LawsUtil::renderLawsViewById($viewId, []);

