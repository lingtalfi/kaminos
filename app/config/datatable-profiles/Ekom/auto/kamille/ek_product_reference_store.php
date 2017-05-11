<?php




$prc = "Ekom.kamille.ek_product_reference_store";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'store_id',
            'quantity',
            'product_reference_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_product_reference_store',
            ],
        ],
    ],
]);
