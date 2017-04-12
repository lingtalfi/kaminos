<?php

use Authenticate\SessionUser\SessionUser;
use Authenticate\UserStore\UserStoreInterface;
use Authenticate\Util\UserToSessionConvertor;
use ClassCooker\ClassCooker;
use Core\Services\A;
use Core\Services\X;
use Kamille\Utils\ModuleUtils\ModuleInstallTool;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";




//az(X::get("Authenticate_test", null, true, true, "pier", "hoo"));
//header("content-type: text/plain");
//ModuleInstallTool::bindModuleHooks('Module\Core\CoreHooks');
////ModuleInstallTool::bindModuleHooks('Module\Test\TestHooks');
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

