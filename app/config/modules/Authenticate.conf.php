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
    /**
     * The controller to use for rendering the login form (which is displayed
     * every time the user is not connected)
     *
     * See AuthenticateRouter for more information.
     */
    "controllerLoginForm" => 'Controller\Authenticate\AuthenticateController:renderForm',

    /**
     * If that key is found in the $_GET array,
     * then it will redirect the user to the same uri, but with the disconnectGetKey
     * parameter removed from the queryString.
     *
     * See AuthenticateRouter for more information.
     *
     */
    "disconnectGetKey" => 'disconnect',
    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * When the form is successfully posted and the credentials are valid,
     * the user is connected.
     * Then, we can choose to redirect the user to another page, or to
     * not redirect her (see AuthenticateController's comments for more info).
     *
     * Use this parameter to choose which mode you want.
     * Possible values are:
     *
     * - false (default): no redirection at all
     * - true: redirect the user to the same page, with the success=1 $_GET flag added
     *         This is useful if you want the user to be able to refresh
     *         the landing page without the post data in it
     * - uri: use the uri defined in onSuccessRedirectValue to set the uri the user should be redirected to
     * - route: use the onSuccessRedirectValue to set a routsy route identifier identifying the route to redirect the user to
     *
     */
    "onSuccessRedirectMode" => false,
    /**
     * Only used if onSuccessRedirectMode is uri or route.
     */
    "onSuccessRedirectValue" => null,
];