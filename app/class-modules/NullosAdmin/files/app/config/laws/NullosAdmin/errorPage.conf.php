<?php

$conf = [
    "widgets" => [
        'maincontent.error' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/Error/default",
            'conf' => [
                "type" => "error",
                "title" => null,
                "message" => "I'm the default error message",
            ],
        ],
    ],
    "grid" => ['maincontent'],
];