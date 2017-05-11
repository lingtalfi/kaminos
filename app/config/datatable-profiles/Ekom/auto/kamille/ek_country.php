<?php




$prc = "Ekom.kamille.ek_country";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'iso_code',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_country',
            ],
        ],
    ],
]);
