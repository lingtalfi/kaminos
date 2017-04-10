<?php


namespace Module\Authenticate;


use Authenticate\BadgeStore\FileBadgeStore;
use Authenticate\Grant\Grantor;
use Authenticate\SessionUser\SessionUser;
use Authenticate\UserStore\FileUserStore;
use Authenticate\Util\UserToSessionConvertor;
use Core\Services\X;
use ;

class AuthenticateServices
{


    protected static function Authenticate_userStore()
    {
        $f = Kamille\Services\XConfig::get("Authenticate.pathUserStore");
        return FileUserStore::create()->setFile($f);
    }

    protected static function Authenticate_grantor()
    {

        $userStore = X::get("Authenticate_userStore");
        //--------------------------------------------
        // SCRIPT
        //--------------------------------------------
        if ("form submitted") {
            $_POST = [
                "username" => "me",
                "pass" => "me",
            ];
            if (false !== ($user = $userStore->getUserByCredentials($_POST['username'], $_POST['pass']))) {


                $props = UserToSessionConvertor::toSession($user);
                SessionUser::connect($props);


                // prepare the badgeStore instance
                $f = $d . "/profiles.php";
                $badgeStore = FileBadgeStore::create()
                    ->setFile($f);


                // prepare the grantor instance
                $grantor = Grantor::create()->setBadgeStore($badgeStore);


                /**
                 * Now we can safely use the grantor (which is the goal of this snippet)
                 */
                a($grantor->has("badge4")); // true


            } else {
                echo "invalid credentials";
            }
        }

        return $grantor;
    }
}


