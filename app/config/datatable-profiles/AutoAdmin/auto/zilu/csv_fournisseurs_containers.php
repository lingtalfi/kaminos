<?php




$prc = "AutoAdmin.zilu.csv_fournisseurs_containers";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'date_commande',
            'container',
            'produit_fr',
            'reference',
            'produits_fr',
            'produits_en',
            'details',
            'quantity',
            'unit',
            'unit_price',
            'total_price',
            'm3',
            'poids',
            'client',
            'ref_hldp',
            'ref_lf',
            'numero_commande',
            'm3_u',
            'kgs_u',
            'facture_lf',
            'commande_en_cours',
            'note',
            'livraison',
            'simulation_date',
            'simulation_date_2',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Csv_fournisseurs_containers',
            ],
        ],
    ],
]);
