<?php


$store = [
    'profiles' => [
        "admin" => [
            "groups" => [
                "AutoAdmin-admin",
            ],
        ],
    ],
    'groups' => [
        "AutoAdmin" => [],
        "AutoAdmin-admin" => [
            "groups" => [],
            "useGenerator",
        ],
    ],
];