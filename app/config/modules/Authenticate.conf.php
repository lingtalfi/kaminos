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
//    /**
//     * If the router is active, then a non authenticated user will be redirected
//     * to the login page.
//     */
    /**
     * The controller to use for rendering the login form (which is displayed
     * every time the user is not connected)
     */
    "controllerLoginForm" => 'Controller\Authenticate\AuthenticateController:renderForm',

    /**
     * If that key is found in the $_GET array,
     * then it will redirect the user to the same uri, but with the disconnectGetKey
     * parameter removed from the queryString.
     *
     */
    "disconnectGetKey" => 'disconnect',
    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * controller to use when the form is successfully posted
     */
    "controllerLoginFormSuccess" => 'disconnect',
    /**
     * uri to redirect to when the form is successfully posted
     */
    "uriLoginFormSuccess" => 'disconnect',
];