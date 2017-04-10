<?php


use Kamille\Ling\Z;

$appDir = Z::appDir();

$conf = [
    /**
     * Path to the user store file
     */
    "pathUserStore" => "$appDir/store/users.php",
    "pathBadgeStore" => "$appDir/store/profiles.php",

    /**
     * Name of the service which returns an instance of
     * a UserStoreInterface (see Authenticate planet
     * for more info).
     */
    "serviceUserStore" => "Authenticate_userStore",
];