<?php


use Kamille\Ling\Z;

$appDir = Z::appDir();

$conf = [
    /**
     * Path to the user store file
     */
    "pathUserStore" => "$appDir/store/Authenticate/users.php",
    "pathBadgeStore" => "$appDir/store/Authenticate/profiles.php",

    /**
     * Name of the service which returns an instance of
     * a UserStoreInterface (see Authenticate planet
     * for more info).
     */
    "serviceUserStore" => "Authenticate_userStore",
    /**
     * Name of the service which returns an instance of
     * a BadgeStoreInterface (see Authenticate planet
     * for more info).
     */
    "serviceBadgeStore" => "Authenticate_badgeStore",
    "controllerLoginForm" => 'Controller\Authenticate\AuthenticateController:renderForm',
];