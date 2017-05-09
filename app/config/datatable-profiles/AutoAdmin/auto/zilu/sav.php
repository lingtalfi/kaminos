<?php




$prc = "AutoAdmin.zilu.sav";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'fournisseur',
            'reference_lf',
            'produit',
            'livre_le',
            'quantite',
            'prix',
            'nb_produits_defec',
            'date_notif',
            'demande_remboursement',
            'montant_rembourse',
            'pourcentage_rembourse',
            'date_remboursement',
            'forme',
            'statut',
            'photo',
            'avancement',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Sav',
            ],
        ],
    ],
]);
