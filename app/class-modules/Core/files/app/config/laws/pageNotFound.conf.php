<?php


$conf = [
    "layout" => [
        "name" => "splash/default",
    ],
    "widgets" => [
        "main.httpError" => [
            "name" => "httpError/default",
            "conf" => [
                "code" => 404,
                "text" => "Page not found",
            ],
        ],
    ],
];