<?php


$tid = "widgets/loginForm/loginForm";

$conf = [
    "layout" => [
        "name" => "splash/default",
        "conf" => [],
    ],
    "widgets" => [
        "main.notification" => [
            /**
             * Primary goal/intent of notification: be a companion for a form
             */
            "name" => "notification/default",
            "conf" => [],
        ],
        "main.loginForm" => [
            "name" => "loginForm/default",
            "conf" => [
                "title" => __("loginForm", $tid),
                "formModel" => null, // to be set by the controller
                "nameUserName" => "username",
                "namePassword" => "password",
                "textUserName" => __("username", $tid),
                "textPassword" => __("password", $tid),
                "textSubmit" => __("submit", $tid),
                "showForgotPasswordLink" => true,
                "uriForgotPassword" => "/password-forgotten",
                "textForgotPassword" => __("passwordLost", $tid),
                "showCreateAccountLink" => true,
                "uriCreateAccount" => "/create-account",
                "textCreateAccount" => __("createAccount", $tid),
            ],
        ],
    ],
];