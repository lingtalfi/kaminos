<?php




$prc = "Ekom.kamille.ek_product_has_video";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'product_id',
            'video_id',
            'action',
        ],
        'ric' => [
            'product_id',
            'video_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_product_has_video',
            ],
        ],
    ],
]);
