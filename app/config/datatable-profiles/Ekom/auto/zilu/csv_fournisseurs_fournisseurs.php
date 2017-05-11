<?php




$prc = "Ekom.zilu.csv_fournisseurs_fournisseurs";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'fournisseur',
            'ref_hldp',
            'ref',
            'produits_fr',
            'produits_en',
            'moq',
            'details',
            'client',
            'quantity',
            'unit',
            'unit_price',
            'total_amount',
            'packing_details',
            'm3',
            'poids',
            'm3_unit',
            'poids_unit',
            'units_20',
            'units_40',
            'units_40hq',
            'lf',
            'reference',
            'champ1',
            'champ2',
            'champ3',
            'champ4',
            'fournisseur_nom1',
            'fournisseur_nom2',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Csv_fournisseurs_fournisseurs',
            ],
        ],
    ],
]);
