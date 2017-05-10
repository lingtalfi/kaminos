<?php

$conf = [
    "widgets" => [
//        'maincontent.topTiles' => [
//            'grid' => "1",
//            'tpl' => "NullosAdmin/Main/TopTiles/default",
//            'conf' => [],
//        ],
        'maincontent.form' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/Form/default",
            'conf' => [
                "formModel" => null,
            ],
        ],
//        'maincontent.dataTable1' => [
//            'grid' => "1",
//            'tpl' => "NullosAdmin/Main/DataTable/prototype",
//            'conf' => [
//                "dataTableModel" => null,
//            ],
//        ],
//        'maincontent.dataTable' => [
//            'grid' => "1",
//            'tpl' => "DataTable_DataTable/default",
//            'conf' => [
//                "profileId" => "test-array",
//            ],
//        ],
    ],
    "grid" => ['maincontent'],
];