<?php


$tid = "widgets/loginForm/loginForm";

/**
 * Todo: form example with authenticate first
 */
$conf = [
    "layout" => [
        "tpl" => "splash/default",
        "conf" => [],
    ],
    "widgets" => [
        "main.loginForm" => [
            "tpl" => "loginForm/default",
            "conf" => [
                "title" => __("loginForm", $tid),
                "formModel" => null, // to be set by the controller


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