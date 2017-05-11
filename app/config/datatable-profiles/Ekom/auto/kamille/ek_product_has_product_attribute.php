<?php




$prc = "Ekom.kamille.ek_product_has_product_attribute";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'product_id',
            'product_attribute_id',
            'product_attibute_value_id',
            'action',
        ],
        'ric' => [
            'product_id',
            'product_attribute_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_product_has_product_attribute',
            ],
        ],
    ],
]);
