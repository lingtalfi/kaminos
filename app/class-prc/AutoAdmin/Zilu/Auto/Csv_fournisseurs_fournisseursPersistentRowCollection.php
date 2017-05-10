<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\HtmlTextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Csv_fournisseurs_fournisseursPersistentRowCollection extends QuickPdoPersistentRowCollection
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
        $model
            ->addControl("fournisseur", InputTextControl::create()
                ->label("fournisseur")
                ->name("fournisseur")
            )
            ->addControl("ref_hldp", InputTextControl::create()
                ->label("ref_hldp")
                ->name("ref_hldp")
            )
            ->addControl("ref", InputTextControl::create()
                ->label("ref")
                ->name("ref")
            )
            ->addControl("produits_fr", HtmlTextAreaControl::create()
                ->label("produits_fr")
                ->name("produits_fr")
            )
            ->addControl("produits_en", HtmlTextAreaControl::create()
                ->label("produits_en")
                ->name("produits_en")
            )
            ->addControl("moq", InputTextControl::create()
                ->label("moq")
                ->name("moq")
            )
            ->addControl("details", HtmlTextAreaControl::create()
                ->label("details")
                ->name("details")
            )
            ->addControl("client", InputTextControl::create()
                ->label("client")
                ->name("client")
            )
            ->addControl("quantity", InputTextControl::create()
                ->label("quantity")
                ->name("quantity")
            )
            ->addControl("unit", InputTextControl::create()
                ->label("unit")
                ->name("unit")
            )
            ->addControl("unit_price", InputTextControl::create()
                ->label("unit_price")
                ->name("unit_price")
            )
            ->addControl("total_amount", InputTextControl::create()
                ->label("total_amount")
                ->name("total_amount")
            )
            ->addControl("packing_details", HtmlTextAreaControl::create()
                ->label("packing_details")
                ->name("packing_details")
            )
            ->addControl("m3", InputTextControl::create()
                ->label("m3")
                ->name("m3")
            )
            ->addControl("poids", InputTextControl::create()
                ->label("poids")
                ->name("poids")
            )
            ->addControl("m3_unit", InputTextControl::create()
                ->label("m3_unit")
                ->name("m3_unit")
            )
            ->addControl("poids_unit", InputTextControl::create()
                ->label("poids_unit")
                ->name("poids_unit")
            )
            ->addControl("units_20", InputTextControl::create()
                ->label("units_20")
                ->name("units_20")
            )
            ->addControl("units_40", InputTextControl::create()
                ->label("units_40")
                ->name("units_40")
            )
            ->addControl("units_40hq", InputTextControl::create()
                ->label("units_40hq")
                ->name("units_40hq")
            )
            ->addControl("lf", InputTextControl::create()
                ->label("lf")
                ->name("lf")
            )
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            )
            ->addControl("champ1", HtmlTextAreaControl::create()
                ->label("champ1")
                ->name("champ1")
            )
            ->addControl("champ2", HtmlTextAreaControl::create()
                ->label("champ2")
                ->name("champ2")
            )
            ->addControl("champ3", HtmlTextAreaControl::create()
                ->label("champ3")
                ->name("champ3")
            )
            ->addControl("champ4", HtmlTextAreaControl::create()
                ->label("champ4")
                ->name("champ4")
            )
            ->addControl("fournisseur_nom1", InputTextControl::create()
                ->label("fournisseur_nom1")
                ->name("fournisseur_nom1")
            )
            ->addControl("fournisseur_nom2", InputTextControl::create()
                ->label("fournisseur_nom2")
                ->name("fournisseur_nom2")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}