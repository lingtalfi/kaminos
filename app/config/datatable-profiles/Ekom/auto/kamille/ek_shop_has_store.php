<?php




$prc = "Ekom.kamille.ek_shop_has_store";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'shop_id',
            'store_id',
            'action',
        ],
        'ric' => [
            'shop_id',
            'store_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_shop_has_store',
            ],
        ],
    ],
]);
