<?php




$prc = "Ekom.kamille.ek_backoffice_user";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'email',
            'pass',
            'lang_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_backoffice_user',
            ],
        ],
    ],
]);
