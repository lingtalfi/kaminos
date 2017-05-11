<?php




$prc = "Ekom.kamille.ek_role_group";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'label',
            'role_group_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_role_group',
            ],
        ],
    ],
]);
