<?php

$conf = [
    "widgets" => [
        'maincontent.dataTable' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/DataTable/default",
            'conf' => [
                "profileId" => "overrideMe",
                "showHeader" => false,
                "title" => "",
                "subtitle" => "",
                "description" => null,
            ],
        ],
    ],
    "grid" => ['maincontent'],
];