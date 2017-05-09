<?php




$prc = "AutoAdmin.zilu.devis";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'reference',
            'date_reception',
            'fournisseur_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Devis',
            ],
        ],
    ],
]);
