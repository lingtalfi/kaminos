<?php




$prc = "Ekom.kamille.ek_state";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'iso_code',
            'label',
            'country_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_state',
            ],
        ],
    ],
]);
