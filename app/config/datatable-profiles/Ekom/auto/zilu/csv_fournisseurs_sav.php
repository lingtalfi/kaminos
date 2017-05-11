<?php




$prc = "Ekom.zilu.csv_fournisseurs_sav";
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
            'remboursement',
            'forme',
            'statut',
            'avoir_lf',
            'date_remboursement',
            'problemes',
            'avancement',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Csv_fournisseurs_sav',
            ],
        ],
    ],
]);
