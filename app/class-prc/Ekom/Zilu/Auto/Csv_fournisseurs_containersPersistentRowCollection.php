<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Csv_fournisseurs_containersPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_fournisseurs_containers");
        $this->fields = '
csv_fournisseurs_containers.id,
csv_fournisseurs_containers.date_commande,
csv_fournisseurs_containers.container,
csv_fournisseurs_containers.produit_fr,
csv_fournisseurs_containers.reference,
csv_fournisseurs_containers.produits_fr,
csv_fournisseurs_containers.produits_en,
csv_fournisseurs_containers.details,
csv_fournisseurs_containers.quantity,
csv_fournisseurs_containers.unit,
csv_fournisseurs_containers.unit_price,
csv_fournisseurs_containers.total_price,
csv_fournisseurs_containers.m3,
csv_fournisseurs_containers.poids,
csv_fournisseurs_containers.client,
csv_fournisseurs_containers.ref_hldp,
csv_fournisseurs_containers.ref_lf,
csv_fournisseurs_containers.numero_commande,
csv_fournisseurs_containers.m3_u,
csv_fournisseurs_containers.kgs_u,
csv_fournisseurs_containers.facture_lf,
csv_fournisseurs_containers.commande_en_cours,
csv_fournisseurs_containers.note,
csv_fournisseurs_containers.livraison,
csv_fournisseurs_containers.simulation_date,
csv_fournisseurs_containers.simulation_date_2
';
        $this->query = '
SELECT
%s
FROM zilu.csv_fournisseurs_containers
';
    }


    public function getRic()
    {
        return [
    'id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        $validator
			->setTests("date_commande", "date_commande", [
                RequiredControlTest::create(),
            ])
			->setTests("container", "container", [
                RequiredControlTest::create(),
            ])
			->setTests("reference", "reference", [
                RequiredControlTest::create(),
            ])
			->setTests("quantity", "quantity", [
                RequiredControlTest::create(),
            ])
			->setTests("unit", "unit", [
                RequiredControlTest::create(),
            ])
			->setTests("unit_price", "unit_price", [
                RequiredControlTest::create(),
            ])
			->setTests("total_price", "total_price", [
                RequiredControlTest::create(),
            ])
			->setTests("m3", "m3", [
                RequiredControlTest::create(),
            ])
			->setTests("poids", "poids", [
                RequiredControlTest::create(),
            ])
			->setTests("client", "client", [
                RequiredControlTest::create(),
            ])
			->setTests("ref_hldp", "ref_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("ref_lf", "ref_lf", [
                RequiredControlTest::create(),
            ])
			->setTests("numero_commande", "numero_commande", [
                RequiredControlTest::create(),
            ])
			->setTests("m3_u", "m3_u", [
                RequiredControlTest::create(),
            ])
			->setTests("kgs_u", "kgs_u", [
                RequiredControlTest::create(),
            ])
			->setTests("facture_lf", "facture_lf", [
                RequiredControlTest::create(),
            ])
			->setTests("commande_en_cours", "commande_en_cours", [
                RequiredControlTest::create(),
            ])
			->setTests("simulation_date", "simulation_date", [
                RequiredControlTest::create(),
            ])
			->setTests("simulation_date_2", "simulation_date_2", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        
    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}