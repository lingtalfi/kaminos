<?php




$prc = "Ekom.kamille.ek_product_reference";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'natural_reference',
            'reference',
            'weight',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_product_reference',
            ],
        ],
    ],
]);
