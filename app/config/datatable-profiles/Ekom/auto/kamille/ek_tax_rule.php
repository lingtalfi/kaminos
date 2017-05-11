<?php




$prc = "Ekom.kamille.ek_tax_rule";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'tax_id',
            'condition',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_tax_rule',
            ],
        ],
    ],
]);
