<?php


namespace Module\Authenticate;


class AuthenticateServices
{


    protected static function Authenticate_userStore()
    {
        $f = \Kamille\Services\XConfig::get("Authenticate.pathUserStore");
        return \Authenticate\UserStore\FileUserStore::create()->setFile($f);
    }

    protected static function Authenticate_badgeStore()
    {
        $f = \Kamille\Services\XConfig::get("Authenticate.pathBadgeStore");
        return \Authenticate\BadgeStore\FileBadgeStore::create()->setFile($f);
    }

    protected static function Authenticate_grantor()
    {
        $badgeStore = \Core\Services\X::get(\Kamille\Services\XConfig::get("Authenticate.serviceBadgeStore"));
        $grantor = \Authenticate\Grant\Grantor::create()->setBadgeStore($badgeStore);
        return $grantor;
    }
//
//    /**
//     *
//     * @return bool
//     */
//    protected static function Authenticate_connect($name, $pass)
//    {
//        /**
//         * @var $userStore \Authenticate\UserStore\UserStoreInterface
//         */
//        $userStore = \Core\Services\X::get(\Kamille\Services\XConfig::get("Authenticate.serviceUserStore"));
//        if (false !== ($user = $userStore->getUserByCredentials($name, $pass))) {
//
//            $props = \Authenticate\Util\UserToSessionConvertor::toSession($user);
//            \Authenticate\SessionUser\SessionUser::connect($props);
//
//            return true;
//
//        }
//        return false;
//    }
}


