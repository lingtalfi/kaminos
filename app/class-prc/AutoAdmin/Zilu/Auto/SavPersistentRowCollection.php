<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class SavPersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.sav");
        $this->fields = '
sav.id,
sav.fournisseur,
sav.reference_lf,
sav.produit,
sav.livre_le,
sav.quantite,
sav.prix,
sav.nb_produits_defec,
sav.date_notif,
sav.demande_remboursement,
sav.montant_rembourse,
sav.pourcentage_rembourse,
sav.date_remboursement,
sav.forme,
sav.statut,
sav.photo,
sav.avancement
';
        $this->query = '
SELECT
%s
FROM zilu.sav
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
			->setTests("forme", "forme", [
                RequiredControlTest::create(),
            ])
			->setTests("photo", "photo", [
                RequiredControlTest::create(),
            ])
			->setTests("avancement", "avancement", [
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
            ->addControl("pourcentage_rembourse", InputTextControl::create()
                ->label("pourcentage_rembourse")
                ->name("pourcentage_rembourse")
            )
            ->addControl("date_remboursement", InputTextControl::create()
                ->label("date_remboursement")
                ->name("date_remboursement")
            )
            ->addControl("forme", InputTextControl::create()
                ->label("forme")
                ->name("forme")
            )
            ->addControl("statut", TextAreaControl::create()
                ->label("statut")
                ->name("statut")
            )
            ->addControl("photo", InputTextControl::create()
                ->label("photo")
                ->name("photo")
            )
            ->addControl("avancement", InputTextControl::create()
                ->label("avancement")
                ->name("avancement")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}