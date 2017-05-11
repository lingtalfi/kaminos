<?php




$prc = "Ekom.kamille.ek_role_group_has_role_badge";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'role_group_id',
            'role_badge_id',
            'action',
        ],
        'ric' => [
            'role_group_id',
            'role_badge_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_role_group_has_role_badge',
            ],
        ],
    ],
]);
