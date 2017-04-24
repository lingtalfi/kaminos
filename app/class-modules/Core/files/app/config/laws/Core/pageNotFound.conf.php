<?php


$conf = [
    "layout" => [
        "tpl" => "splash/default",
    ],
    "widgets" => [
        "main.httpError" => [
            "tpl" => "HttpError/default",
            "conf" => [
                "code" => 404,
                "text" => "Page not found",
            ],
        ],
    ],
];