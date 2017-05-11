<?php




$prc = "Ekom.kamille.ek_role_profile_has_role_group";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'role_profile_id',
            'role_group_id',
            'action',
        ],
        'ric' => [
            'role_profile_id',
            'role_group_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_role_profile_has_role_group',
            ],
        ],
    ],
]);
