<?php

$conf = [
    "widgets" => [
        'maincontent.topTiles' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/TopTiles/default",
            'conf' => [],
        ],
//        'maincontent.form' => [
//            'grid' => "1",
//            'tpl' => "NullosAdmin/Main/Form/default",
//            'conf' => [
//                "formModel" => null,
//            ],
//        ],
        'maincontent.dataTable' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/DataTable/prototype",
            'conf' => [
                "dataTableModel" => null,
            ],
        ],
    ],
    "grid" => ['maincontent'],
];