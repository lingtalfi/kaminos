<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Csv_fournisseurs_fournisseursPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_fournisseurs_fournisseurs");
        $this->fields = '
csv_fournisseurs_fournisseurs.id,
csv_fournisseurs_fournisseurs.fournisseur,
csv_fournisseurs_fournisseurs.ref_hldp,
csv_fournisseurs_fournisseurs.ref,
csv_fournisseurs_fournisseurs.produits_fr,
csv_fournisseurs_fournisseurs.produits_en,
csv_fournisseurs_fournisseurs.moq,
csv_fournisseurs_fournisseurs.details,
csv_fournisseurs_fournisseurs.client,
csv_fournisseurs_fournisseurs.quantity,
csv_fournisseurs_fournisseurs.unit,
csv_fournisseurs_fournisseurs.unit_price,
csv_fournisseurs_fournisseurs.total_amount,
csv_fournisseurs_fournisseurs.packing_details,
csv_fournisseurs_fournisseurs.m3,
csv_fournisseurs_fournisseurs.poids,
csv_fournisseurs_fournisseurs.m3_unit,
csv_fournisseurs_fournisseurs.poids_unit,
csv_fournisseurs_fournisseurs.units_20,
csv_fournisseurs_fournisseurs.units_40,
csv_fournisseurs_fournisseurs.units_40hq,
csv_fournisseurs_fournisseurs.lf,
csv_fournisseurs_fournisseurs.reference,
csv_fournisseurs_fournisseurs.champ1,
csv_fournisseurs_fournisseurs.champ2,
csv_fournisseurs_fournisseurs.champ3,
csv_fournisseurs_fournisseurs.champ4,
csv_fournisseurs_fournisseurs.fournisseur_nom1,
csv_fournisseurs_fournisseurs.fournisseur_nom2
';
        $this->query = '
SELECT
%s
FROM zilu.csv_fournisseurs_fournisseurs
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
			->setTests("fournisseur", "fournisseur", [
                RequiredControlTest::create(),
            ])
			->setTests("ref_hldp", "ref_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("ref", "ref", [
                RequiredControlTest::create(),
            ])
			->setTests("moq", "moq", [
                RequiredControlTest::create(),
            ])
			->setTests("client", "client", [
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
			->setTests("total_amount", "total_amount", [
                RequiredControlTest::create(),
            ])
			->setTests("m3", "m3", [
                RequiredControlTest::create(),
            ])
			->setTests("poids", "poids", [
                RequiredControlTest::create(),
            ])
			->setTests("m3_unit", "m3_unit", [
                RequiredControlTest::create(),
            ])
			->setTests("poids_unit", "poids_unit", [
                RequiredControlTest::create(),
            ])
			->setTests("units_20", "units_20", [
                RequiredControlTest::create(),
            ])
			->setTests("units_40", "units_40", [
                RequiredControlTest::create(),
            ])
			->setTests("units_40hq", "units_40hq", [
                RequiredControlTest::create(),
            ])
			->setTests("lf", "lf", [
                RequiredControlTest::create(),
            ])
			->setTests("reference", "reference", [
                RequiredControlTest::create(),
            ])
			->setTests("fournisseur_nom1", "fournisseur_nom1", [
                RequiredControlTest::create(),
            ])
			->setTests("fournisseur_nom2", "fournisseur_nom2", [
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