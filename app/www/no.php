<?php


use Authenticate\SessionUser\SessionUser;
use Authenticate\UserStore\UserStoreInterface;
use Authenticate\Util\UserToSessionConvertor;
use ClassCooker\ClassCooker;
use Core\Services\A;
use Core\Services\X;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Utils\Laws\LawsUtil;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";




$f = '/myphp/kaminos/app/class-core/Services/X.php';
a(ClassCooker::create()->setFile($f)->getMethodsBoundaries());
a(ClassCooker::create()->setFile($f)->getMethodsBoundaries(['protected', 'static']));




az();
/**
 * @var $userStore UserStoreInterface
 */
$userStore = X::get("Authenticate_userStore");

if (false !== ($user = $userStore->getUserByCredentials("me", "me"))) {

    $props = UserToSessionConvertor::toSession($user);
    SessionUser::connect($props);

    a(A::has("badge2"));

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

