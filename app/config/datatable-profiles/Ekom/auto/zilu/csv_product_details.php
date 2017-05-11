<?php




$prc = "Ekom.zilu.csv_product_details";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'ref',
            'product_fr',
            'product',
            'photo',
            'features',
            'logo',
            'packing',
            'ean',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Csv_product_details',
            ],
        ],
    ],
]);
