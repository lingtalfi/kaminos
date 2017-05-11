<?php




$prc = "Ekom.zilu.commande_has_article";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'commande_id',
            'article_id',
            'container_id',
            'fournisseur_id',
            'sav_id',
            'commande_ligne_statut_id',
            'prix_override',
            'date_estimee',
            'quantite',
            'unit',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Commande_has_article',
            ],
        ],
    ],
]);
