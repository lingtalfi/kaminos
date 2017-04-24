<?php


$conf = [
    "layout" => [
        "tpl" => "splash/default",
    ],
    "widgets" => [
        "main.exception" => [
            "tpl" => "Exception/default",
            "conf" => [
                "showMessage" => true,
                "showTrace" => true,
                "showFile" => true,
                "showCode" => true,
                "showLine" => true,
            ],
        ],
    ],
];