<?php




$prc = "AutoAdmin.zilu.csv_prix_materiel";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'reference',
            'reference_fournisseur',
            'fournisseur',
            'produits',
            'libelle_origine',
            'unit',
            'pmp_achat_dollar',
            'pmp_achat_euro',
            'port',
            'paht_frais',
            'pv_public_ht',
            'marge_prix_public',
            'pv_public_ttc',
            'prix_pro',
            'remise_club',
            'marge_prix_club',
            'prix_franchise',
            'remise_franchise',
            'marge_franchise',
            'poids_net',
            'poids',
            'famille_produit',
            'dimensions',
            'code_compta',
            'description',
            'photos',
            'tva',
            'code_ean',
            'date_arrivee',
            'm3',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Csv_prix_materiel',
            ],
        ],
    ],
]);
