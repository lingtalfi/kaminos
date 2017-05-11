<?php




$prc = "Ekom.kamille.ek_shop_has_product";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'shop_id',
            'product_id',
            'active',
            'action',
        ],
        'ric' => [
            'shop_id',
            'product_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_shop_has_product',
            ],
        ],
    ],
]);
