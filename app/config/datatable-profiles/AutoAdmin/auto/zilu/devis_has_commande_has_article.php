<?php




$prc = "AutoAdmin.zilu.devis_has_commande_has_article";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'devis_id',
            'commande_has_article_id',
            'action',
        ],
        'ric' => [
            'devis_id',
            'commande_has_article_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Devis_has_commande_has_article',
            ],
        ],
    ],
]);
