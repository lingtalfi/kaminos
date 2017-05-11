<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class SavPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
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
            ->addControl("livre_le", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("livre_le")
                ->name("livre_le")
            )
            ->addControl("date_notif", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_notif")
                ->name("date_notif")
            )
            ->addControl("date_remboursement", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_remboursement")
                ->name("date_remboursement")
            )
            ->addControl("photo", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("Ekom/zilu.sav.photo")            
                ->label("photo")
                ->name("photo")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}