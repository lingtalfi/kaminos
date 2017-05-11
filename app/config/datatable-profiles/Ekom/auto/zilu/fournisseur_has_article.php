<?php




$prc = "Ekom.zilu.fournisseur_has_article";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'fournisseur_id',
            'article_id',
            'reference',
            'prix',
            'volume',
            'poids',
            'action',
        ],
        'ric' => [
            'fournisseur_id',
            'article_id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Fournisseur_has_article',
            ],
        ],
    ],
]);
