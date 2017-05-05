<?php

$conf = [
    "widgets" => [
        'maincontent.pageTitle' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/PageTitle/default",
            'conf' => [
                "Title" => "Users",
                "subtitle" => "Manage the users of your application",
            ],
        ],
        'maincontent.dataTable' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/DataTable/default",
            'conf' => [
                "showHeader" => true, // default: true
                "title" => "Users", // default: null
                "subtitle" => "Users list",
                "description" => null, // default: null
                "profileId" => "NullosAdmin/users",
            ],
        ],
    ],
    "grid" => ['maincontent'],
];