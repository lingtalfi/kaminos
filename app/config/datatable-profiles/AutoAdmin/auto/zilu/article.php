<?php




$prc = "AutoAdmin.zilu.article";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'reference_lf',
            'reference_hldp',
            'descr_fr',
            'descr_en',
            'ean',
            'photo',
            'logo',
            'long_desc_en',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Article',
            ],
        ],
    ],
]);
