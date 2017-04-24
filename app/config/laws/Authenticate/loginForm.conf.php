<?php


$t = "widgets/LoginForm/LoginForm";

$conf = [
    "layout" => [
        "tpl" => "splash/default",
        "conf" => [],
    ],
    "widgets" => [
        "main.notification" => [
            /**
             * Primary goal/intent of notification: be a companion for a form
             */
            "tpl" => "Notification/default",
            "conf" => [],
        ],
        "main.loginForm" => [
            "tpl" => "LoginForm/default",
            "conf" => [
                "title" => __("loginForm", $t),
                "formModel" => null, // to be set by the controller


                "showForgotPasswordLink" => true,
                "uriForgotPassword" => "/password-forgotten",
                "textForgotPassword" => __("passwordLost", $t),
                "showCreateAccountLink" => true,
                "uriCreateAccount" => "/create-account",
                "textCreateAccount" => __("createAccount", $t),
                "textNewToSite" => __("newToSite", $t),
                "textSubmit" => __("submit", $t),
            ],
        ],
    ],
];