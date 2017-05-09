<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Csv_fournisseurs_containersPersistentRowCollection extends QuickPdoPersistentRowCollection
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
        $model
            ->addControl("date_commande", InputTextControl::create()
                ->label("date_commande")
                ->name("date_commande")
            )
            ->addControl("container", InputTextControl::create()
                ->label("container")
                ->name("container")
            )
            ->addControl("produit_fr", TextAreaControl::create()
                ->label("produit_fr")
                ->name("produit_fr")
            )
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            )
            ->addControl("produits_fr", TextAreaControl::create()
                ->label("produits_fr")
                ->name("produits_fr")
            )
            ->addControl("produits_en", TextAreaControl::create()
                ->label("produits_en")
                ->name("produits_en")
            )
            ->addControl("details", TextAreaControl::create()
                ->label("details")
                ->name("details")
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
            ->addControl("total_price", InputTextControl::create()
                ->label("total_price")
                ->name("total_price")
            )
            ->addControl("m3", InputTextControl::create()
                ->label("m3")
                ->name("m3")
            )
            ->addControl("poids", InputTextControl::create()
                ->label("poids")
                ->name("poids")
            )
            ->addControl("client", InputTextControl::create()
                ->label("client")
                ->name("client")
            )
            ->addControl("ref_hldp", InputTextControl::create()
                ->label("ref_hldp")
                ->name("ref_hldp")
            )
            ->addControl("ref_lf", InputTextControl::create()
                ->label("ref_lf")
                ->name("ref_lf")
            )
            ->addControl("numero_commande", InputTextControl::create()
                ->label("numero_commande")
                ->name("numero_commande")
            )
            ->addControl("m3_u", InputTextControl::create()
                ->label("m3_u")
                ->name("m3_u")
            )
            ->addControl("kgs_u", InputTextControl::create()
                ->label("kgs_u")
                ->name("kgs_u")
            )
            ->addControl("facture_lf", InputTextControl::create()
                ->label("facture_lf")
                ->name("facture_lf")
            )
            ->addControl("commande_en_cours", InputTextControl::create()
                ->label("commande_en_cours")
                ->name("commande_en_cours")
            )
            ->addControl("note", TextAreaControl::create()
                ->label("note")
                ->name("note")
            )
            ->addControl("livraison", TextAreaControl::create()
                ->label("livraison")
                ->name("livraison")
            )
            ->addControl("simulation_date", InputTextControl::create()
                ->label("simulation_date")
                ->name("simulation_date")
            )
            ->addControl("simulation_date_2", InputTextControl::create()
                ->label("simulation_date_2")
                ->name("simulation_date_2")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}