<?php




$prc = "Ekom.kamille.ek_address";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'type',
            'city',
            'postcode',
            'address',
            'active',
            'state_id',
            'country_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_address',
            ],
        ],
    ],
]);
