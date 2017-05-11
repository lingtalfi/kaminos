<?php




$prc = "Ekom.kamille.ek_product_reference_shop";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'image',
            'prix_ht',
            'shop_id',
            'product_reference_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_product_reference_shop',
            ],
        ],
    ],
]);
