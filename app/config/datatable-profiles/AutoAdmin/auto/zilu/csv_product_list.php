<?php




$prc = "AutoAdmin.zilu.csv_product_list";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'ref_hldp',
            'ref_lf',
            'produits',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Csv_product_list',
            ],
        ],
    ],
]);
