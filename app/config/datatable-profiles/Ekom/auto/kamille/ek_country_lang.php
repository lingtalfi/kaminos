<?php




$prc = "Ekom.kamille.ek_country_lang";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'country_id',
            'lang_id',
            'label',
            'action',
        ],
        'ric' => [
            'country_id',
            'lang_id',
            'label',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_country_lang',
            ],
        ],
    ],
]);
