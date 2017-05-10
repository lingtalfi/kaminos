<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\HtmlTextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Csv_fournisseurs_savPersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_fournisseurs_sav");
        $this->fields = '
csv_fournisseurs_sav.id,
csv_fournisseurs_sav.fournisseur,
csv_fournisseurs_sav.reference_lf,
csv_fournisseurs_sav.produit,
csv_fournisseurs_sav.livre_le,
csv_fournisseurs_sav.quantite,
csv_fournisseurs_sav.prix,
csv_fournisseurs_sav.nb_produits_defec,
csv_fournisseurs_sav.date_notif,
csv_fournisseurs_sav.demande_remboursement,
csv_fournisseurs_sav.montant_rembourse,
csv_fournisseurs_sav.remboursement,
csv_fournisseurs_sav.forme,
csv_fournisseurs_sav.statut,
csv_fournisseurs_sav.avoir_lf,
csv_fournisseurs_sav.date_remboursement,
csv_fournisseurs_sav.problemes,
csv_fournisseurs_sav.avancement
';
        $this->query = '
SELECT
%s
FROM zilu.csv_fournisseurs_sav
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
			->setTests("reference_lf", "reference_lf", [
                RequiredControlTest::create(),
            ])
			->setTests("produit", "produit", [
                RequiredControlTest::create(),
            ])
			->setTests("livre_le", "livre_le", [
                RequiredControlTest::create(),
            ])
			->setTests("quantite", "quantite", [
                RequiredControlTest::create(),
            ])
			->setTests("prix", "prix", [
                RequiredControlTest::create(),
            ])
			->setTests("nb_produits_defec", "nb_produits_defec", [
                RequiredControlTest::create(),
            ])
			->setTests("date_notif", "date_notif", [
                RequiredControlTest::create(),
            ])
			->setTests("demande_remboursement", "demande_remboursement", [
                RequiredControlTest::create(),
            ])
			->setTests("montant_rembourse", "montant_rembourse", [
                RequiredControlTest::create(),
            ])
			->setTests("remboursement", "remboursement", [
                RequiredControlTest::create(),
            ])
			->setTests("forme", "forme", [
                RequiredControlTest::create(),
            ])
			->setTests("statut", "statut", [
                RequiredControlTest::create(),
            ])
			->setTests("avoir_lf", "avoir_lf", [
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
            ->addControl("reference_lf", InputTextControl::create()
                ->label("reference_lf")
                ->name("reference_lf")
            )
            ->addControl("produit", InputTextControl::create()
                ->label("produit")
                ->name("produit")
            )
            ->addControl("livre_le", InputTextControl::create()
                ->label("livre_le")
                ->name("livre_le")
            )
            ->addControl("quantite", InputTextControl::create()
                ->label("quantite")
                ->name("quantite")
            )
            ->addControl("prix", InputTextControl::create()
                ->label("prix")
                ->name("prix")
            )
            ->addControl("nb_produits_defec", InputTextControl::create()
                ->label("nb_produits_defec")
                ->name("nb_produits_defec")
            )
            ->addControl("date_notif", InputTextControl::create()
                ->label("date_notif")
                ->name("date_notif")
            )
            ->addControl("demande_remboursement", InputTextControl::create()
                ->label("demande_remboursement")
                ->name("demande_remboursement")
            )
            ->addControl("montant_rembourse", InputTextControl::create()
                ->label("montant_rembourse")
                ->name("montant_rembourse")
            )
            ->addControl("remboursement", InputTextControl::create()
                ->label("remboursement")
                ->name("remboursement")
            )
            ->addControl("forme", InputTextControl::create()
                ->label("forme")
                ->name("forme")
            )
            ->addControl("statut", InputTextControl::create()
                ->label("statut")
                ->name("statut")
            )
            ->addControl("avoir_lf", InputTextControl::create()
                ->label("avoir_lf")
                ->name("avoir_lf")
            )
            ->addControl("date_remboursement", HtmlTextAreaControl::create()
                ->label("date_remboursement")
                ->name("date_remboursement")
            )
            ->addControl("problemes", HtmlTextAreaControl::create()
                ->label("problemes")
                ->name("problemes")
            )
            ->addControl("avancement", HtmlTextAreaControl::create()
                ->label("avancement")
                ->name("avancement")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}