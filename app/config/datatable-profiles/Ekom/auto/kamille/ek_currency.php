<?php




$prc = "Ekom.kamille.ek_currency";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'iso_code',
            'symbol',
            'exchange_rate',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_currency',
            ],
        ],
    ],
]);
