<?php




$prc = "AutoAdmin.zilu.historique_statut";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'date',
            'statut_nom',
            'reference_lf',
            'fournisseur_nom',
            'reference_fournisseur',
            'commande_reference',
            'commentaire',
            'commande_has_article_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Historique_statut',
            ],
        ],
    ],
]);
