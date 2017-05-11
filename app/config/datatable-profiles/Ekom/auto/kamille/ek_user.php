<?php




$prc = "Ekom.kamille.ek_user";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'user_group_id',
            'email',
            'pass',
            'base_shop_id',
            'date_creation',
            'active',
            'main_address_id',
            'mobile',
            'phone',
            'pro',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_user',
            ],
        ],
    ],
]);
